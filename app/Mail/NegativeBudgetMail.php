<?php

namespace App\Mail;

namespace App\Mail;

use App\Models\Budget;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NegativeBudgetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $budget;

    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function build()
    {
        return $this->subject('Alert: You Have Overspent Your Budget!. Your budget in negative.......')
            ->view('emails.negative_budget');
    }
}
