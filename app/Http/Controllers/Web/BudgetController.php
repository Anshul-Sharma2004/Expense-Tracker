<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller {
    public function index() {
    $budgets = Budget::where('user_id', Auth::id())->get();

    // Calculate remaining budget for each budget
    foreach ($budgets as $budget) {
        // sum of expenses related to this budget month and year
        $totalExpenses = $budget->expenses()->sum('amount');
        $budget->remaining = $budget->amount - $totalExpenses;
    }

    return view('dashboard', compact('budgets'));
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

}
