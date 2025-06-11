<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BudgetController;
use App\Http\Controllers\Web\ExpenseController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\WhatsAppController;

Route::get('/send-whatsapp', [WhatsAppController::class, 'send']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public route
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Protected routes (only for authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard shows budget (from BudgetController)
    Route::get('/dashboard', [BudgetController::class, 'index'])->name('dashboard');

    // Budget routes
    Route::post('/budget', [BudgetController::class, 'store']);

    // Expense routes
    Route::get('/calendar', [ExpenseController::class, 'calendar']);
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/calendar', [ExpenseController::class, 'calendar'])->name('expenses.calendar');
    Route::get('/expenses/search', [ExpenseController::class, 'search'])->name('expenses.search');

    // Task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/expenses/download', [ExpenseController::class, 'downloadPdf'])->name('expenses.download');

});
