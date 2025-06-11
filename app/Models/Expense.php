<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'budget_id',
        'date',
        'category',
        'amount',
        'description',
    ];

    /**
     * Get the user who owns the expense.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the budget that this expense belongs to.
     */
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
