<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class WhatsAppService
{
    public function sendBudgetNotification(User $user)
    {
        if (empty($user->phone_number)) {
            Log::warning("No phone number for user {$user->id}");
            return false;
        }

        $budgetStatus = $this->getBudgetStatus($user);

        $message = $this->createBudgetMessage($budgetStatus);

        if ($message) {
            return $this->sendMessage($user->phone_number, $message);
        }

        return false;
    }

    private function getBudgetStatus(User $user): ?float
    {
        $budget = $user->budgets()->first();

        if (!$budget || $budget->amount == 0) {
            return null;
        }

        $totalBudget = $budget->amount;
        $usedBudget = $budget->expenses()->sum('amount');

        return ($usedBudget / $totalBudget) * 100;
    }

    private function createBudgetMessage(?float $percentageUsed): ?string
    {
        if ($percentageUsed === null) {
            return null;
        }

        if ($percentageUsed >= 100) {
            return 'Alert: Your budget has been fully utilized (100%). Please review your expenses.';
        } elseif ($percentageUsed > 100) {
            return 'Urgent: Your budget has been overexpended! Current usage: ' . number_format($percentageUsed, 2) . '%.';
        } elseif ($percentageUsed >= 50) {
            return 'Notice: Your budget has reached ' . number_format($percentageUsed, 2) . '% utilization.';
        }

        return null;
    }

    public function sendMessage(string $phoneNumber, string $message): bool
    {
        try {
            // Replace this with actual WhatsApp API call
            Log::info("WhatsApp message to {$phoneNumber}: {$message}");
            return true;
        } catch (\Exception $e) {
            Log::error("WhatsApp failed to {$phoneNumber}: {$e->getMessage()}");
            return false;
        }
    }
}
