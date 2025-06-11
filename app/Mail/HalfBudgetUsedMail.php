<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Budget;

class HalfBudgetUsedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $budget;

    /**
     * Create a new message instance.
     *
     * @param Budget $budget
     * @return void
     */
    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have used 50% of your budget')
                    ->view('emails.half_budget_used')
                    ->with([
                        'budgetAmount' => $this->budget->amount,
                        'month' => $this->budget->month,
                        'year' => $this->budget->year,
                    ]);
    }
}
