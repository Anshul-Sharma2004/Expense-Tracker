<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array<int, class-string|string>
     */
    protected $commands = [
        \App\Console\Commands\SendBudgetReminderEmail::class,
    ];

    /**
     * Define the application's command schedule.
     */
   protected function schedule(Schedule $schedule)
{
    // Budget reminders on 1st of each month at 8:00 AM
    $schedule->command('budget:send-reminders')
             ->monthlyOn(1, '08:00');
    
    // Daily budget alerts (WhatsApp notifications) at 6:00 PM
    $schedule->call(function () {
        $whatsappService = app(\App\Services\WhatsAppService::class);
        $users = User::has('budgets')->whereNotNull('phone_number')->get();
        
        foreach ($users as $user) {
            $whatsappService->sendBudgetNotification($user);
        }
    })->dailyAt('18:00');



}
// $schedule->command('budget:send-reminder')->everyTenMinutes();


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}