<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Budget;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Services\WhatsAppService;
use App\Mail\BudgetReminderMail;
use App\Mail\BudgetUsageAlertMail;

class SendBudgetReminderEmail extends Command
{
    protected $signature = 'budget:send-reminder';

    protected $description = 'Send email and WhatsApp reminders to users to fill monthly budget and notify if budget is 50% or 100% used';

    public function __construct(
        private WhatsAppService $whatsappService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $month = $today->month;
        $year = $today->year;

        $users = User::with('budgets.expenses')->whereNotNull('phone_number')->get();

        foreach ($users as $user) {
            // --- 1. Monthly Budget Reminder (only on 1st day of the month) ---
            if ($today->day === 1) {
                $hasBudget = Budget::where('user_id', $user->id)
                    ->where('month', $month)
                    ->where('year', $year)
                    ->exists();

                if (!$hasBudget) {
                    // Send email
                    Mail::to($user->email)->send(new BudgetReminderMail($user, $month, $year));
                    $this->info("Email reminder sent to user: {$user->email}");

                    // Send WhatsApp
                    $message = "Reminder: Please set your budget for {$today->format('F Y')} in your expense tracker.";
                    $this->whatsappService->sendMessage($user->phone_number, $message);
                    $this->info("WhatsApp reminder sent to user: {$user->phone_number}");
                }
            }

            // --- 2. Budget Usage Notifications (any day) ---
            $budget = $user->budgets()->latest()->first();

            if ($budget) {
                $used = $budget->expenses()->sum('amount');
                $total = $budget->amount;

                if ($total == 0) continue;

                $percentage = ($used / $total) * 100;

                if ($percentage >= 50 && $percentage < 100) {
                    $message = "Notice: Your budget is 50% used.";
                } elseif ($percentage >= 100) {
                    $message = "Alert: Your budget is fully used.";
                } else {
                    continue;
                }

                // Send WhatsApp notification
                $this->whatsappService->sendMessage($user->phone_number, $message);
                $this->info("WhatsApp usage alert sent to user: {$user->phone_number}");

                // Send Email notification
                Mail::to($user->email)->send(new BudgetUsageAlertMail($user, $percentage));
                $this->info("Email usage alert sent to user: {$user->email}");
            }
        }

        return 0;
    }
}
