<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;

class BudgetController extends Controller {
    public function index() {
        $budgets = Budget::where('user_id', Auth::id())->get();

        // Calculate remaining budget for each budget
        foreach ($budgets as $budget) {
            $totalExpenses = $budget->expenses()->sum('amount');
            $budget->remaining = $budget->amount - $totalExpenses;
        }

        // Calculate budget status counts
        $onTrackCount = $budgets->filter(function($budget) {
            return $budget->remaining >= ($budget->amount * 0.5);
        })->count();

        $warningCount = $budgets->filter(function($budget) {
            return $budget->remaining > 0 && $budget->remaining < ($budget->amount * 0.5);
        })->count();

        $overBudgetCount = $budgets->filter(function($budget) {
            return $budget->remaining <= 0;  // Changed to <= to include exactly 0
        })->count();

        return view('dashboard', [
            'budgets' => $budgets,
            'onTrackCount' => $onTrackCount,
            'warningCount' => $warningCount,
            'overBudgetCount' => $overBudgetCount
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'amount' => 'required|numeric|min:0'
        ]);

        $existingBudget = Budget::where('user_id', Auth::id())
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->first();

        if ($existingBudget) {
            return back()->withErrors(['month' => 'Budget for this month and year already exists.']);
        }

        Budget::create([
            'user_id' => Auth::id(),
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount
        ]);

        return redirect('/calendar')->with('success', 'Budget created successfully.');
    }

    public function edit(Budget $budget)
{
    return view('budgets.edit', compact('budget'));
}
public function update(Request $request, Budget $budget)
{
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0',
    ]);

    $budget->update($validated);

    // ✅ Correct plural route
    return redirect()->route('budgets.index')->with('success', 'Budget updated successfully!');
}

public function destroy(Budget $budget)
{
    $budget->delete();

    // ✅ Correct plural route
    return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully!');
}



}