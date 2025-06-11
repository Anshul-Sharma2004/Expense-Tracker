<?php

namespace App\Http\Controllers;

use App\Services\UltraMsgService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WhatsAppController extends Controller
{
    public function send()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        if (empty($user->phoneNumber)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No phone number registered for this user'
            ]);
        }

        $whatsapp = new UltraMsgService();
        $to = $user->phoneNumber;

        $budgetStatus = $this->getBudgetStatus($user->id);

        $message = null;

        if ($budgetStatus > 100) {
            $message = 'Urgent: You have overexpended your budget! Current usage is ' . number_format($budgetStatus, 2) . '%.';
        } elseif ($budgetStatus == 100) {
            $message = 'Alert: Your budget has been fully utilized (100%). Please review your expenses.';
        } elseif ($budgetStatus >= 50) {
            $message = 'Notice: Your budget has reached ' . number_format($budgetStatus, 2) . '% utilization.';
        }

        if (!$message) {
            return response()->json([
                'status' => 'No message sent',
                'reason' => 'Budget below threshold'
            ]);
        }

        $result = $whatsapp->sendMessage($to, $message);
        return response()->json($result);
    }

    private function getBudgetStatus($userId)
    {
        $user = User::with(['budgets.expenses'])->find($userId);
        $latestBudget = $user?->budgets()->latest()->first();

        if (!$latestBudget || $latestBudget->amount == 0) {
            return 0;
        }

        $usedBudget = $latestBudget->expenses()->sum('amount');
        $totalBudget = $latestBudget->amount;

        // Can return values > 100 if overused
        return ($usedBudget / $totalBudget) * 100;
    }
}
