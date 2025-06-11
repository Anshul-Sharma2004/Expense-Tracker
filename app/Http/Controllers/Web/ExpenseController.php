<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Budget;
use App\Mail\HalfBudgetUsedMail;
use App\Mail\FullBudgetUsedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseController extends Controller
{
    // Show calendar with optional filtering by month and year
    public function calendar(Request $request)
    {
        $userId = Auth::id();

        // Determine month and year for filtering or default to current month/year
        if ($request->filled('month') && $request->filled('year')) {
            $month = intval($request->month);
            $year = intval($request->year);
        } else {
            $now = Carbon::now();
            $month = $now->month;
            $year = $now->year;
        }

        // Check if budget exists for this user, month and year
        $budgetExists = Budget::where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->exists();

        if (!$budgetExists) {
            return redirect()->route('budget.index')
                ->with('error', 'Please set your budget for ' . sprintf('%02d', $month) . '/' . $year . ' before accessing the calendar.');
        }

        // Validate month and year query params if present (optional, but recommended)
        $request->validate([
            'month' => 'nullable|digits_between:1,2|integer|min:1|max:12',
            'year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $query = Expense::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month);

        $expenses = $query->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($expense) {
                return Carbon::parse($expense->date)->format('F Y'); // e.g., "June 2025"
            });

        return view('calendar', compact('expenses'));
    }

    // Store new expense and check budget
   public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'category' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:1000',
    ]);

    $user = Auth::user();

    $expenseDate = Carbon::parse($request->date);
    $month = $expenseDate->month;
    $year = $expenseDate->year;

    // Find budget for the expense month and year
    $budget = Budget::where('user_id', $user->id)
        ->where('month', $month)
        ->where('year', $year)
        ->first();

    if (!$budget) {
        return back()->withErrors(['budget' => 'No budget found for the selected month and year. Please create a budget first.'])->withInput();
    }

    $expense = new Expense([
        'user_id' => $user->id,
        'budget_id' => $budget->id,
        'date' => $request->date,
        'category' => $request->category,
        'amount' => $request->amount,
        'description' => $request->description,
    ]);
    $expense->save();

    // Calculate total spent on budget and notify if needed
    $totalSpent = Expense::where('budget_id', $budget->id)->sum('amount');
    $percentage = ($totalSpent / $budget->amount) * 100;

    try {
        if ($percentage >= 50 && !$budget->notified_50) {
            Mail::to($user->email)->send(new HalfBudgetUsedMail($budget));
            $budget->notified_50 = true;
        }

        if ($percentage >= 100 && !$budget->notified_100) {
            Mail::to($user->email)->send(new FullBudgetUsedMail($budget));
            $budget->notified_100 = true;
        }

        if ($percentage > 100 && !$budget->notified_negative) {
            Mail::to($user->email)->send(new \App\Mail\NegativeBudgetMail($budget));
            $budget->notified_negative = true;
        }

    } catch (\Exception $e) {
        Log::error('Mail sending failed: ' . $e->getMessage());
    }

    $budget->save();

    if ($percentage > 100) {
        return back()->with([
            'success' => 'Expense added successfully!',
            'alert' => 'You have exceeded your budget for this month!',
        ]);
    }

    return back()->with('success', 'Expense added successfully!');
}

    // Search expenses by month and year
public function search(Request $request)
{
    $request->validate([
        'month' => 'required',
        'year' => 'required',
    ]);

    $userId = Auth::id();
    $month = $request->month;
    $year = $request->year;

    // Fetch expenses (unsorted initially)
    $expensesFlat = Expense::whereMonth('date', $month)
        ->whereYear('date', $year)
        ->where('user_id', $userId)
        ->get();

    // Sort by date ASC (oldest first)
    $expensesFlat = $expensesFlat->sortBy('date')->values();

    // Fetch user's budget
    $budget = Budget::where('user_id', $userId)
        ->where('month', $month)
        ->where('year', $year)
        ->first();

    $totalBudget = $budget ? $budget->amount : 0;
    $totalSpent = $expensesFlat->sum('amount');
    $remainingBudget = $totalBudget - $totalSpent;

    return view('calendar', [
        'expensesFlat' => $expensesFlat,
        'expenses' => collect([]),
        'remainingBudget' => $remainingBudget,
        'totalBudget' => $totalBudget,
        'totalSpent' => $totalSpent,
        'month' => $month,
        'year' => $year,
    ]);
}


public function downloadPdf(Request $request)
{
    $month = $request->input('month');
    $year = $request->input('year');
    $userId = Auth::id();

    // Fetch expenses
    $expensesFlat = Expense::whereMonth('date', $month)
        ->whereYear('date', $year)
        ->where('user_id', $userId)
        ->get();

    // Fetch budget
    $budget = Budget::where('user_id', $userId)
        ->where('month', $month)
        ->where('year', $year)
        ->first();

    $totalBudget = $budget ? $budget->amount : 0;
    $totalSpent = $expensesFlat->sum('amount');
    $remainingBudget = $totalBudget - $totalSpent;

    $pdf = Pdf::loadView('expenses.pdf', compact(
        'expensesFlat',
        'month',
        'year',
        'totalBudget',
        'totalSpent',
        'remainingBudget'
    ));

    return $pdf->download("expenses_{$month}_{$year}.pdf");
}

}
