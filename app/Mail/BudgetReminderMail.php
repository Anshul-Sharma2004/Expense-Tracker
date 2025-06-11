<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BudgetReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $month;
    public $year;

    public function __construct($user, $month, $year)
    {
        $this->user = $user;
        $this->month = $month;
        $this->year = $year;
    }

    public function build()
    {
        return $this->subject("Reminder: Please fill your budget for {$this->month}/{$this->year}")
                    ->view('emails.budget-reminder');
    }
}
