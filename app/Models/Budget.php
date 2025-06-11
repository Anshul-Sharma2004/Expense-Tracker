<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'year',
        'amount',
        'notified_50',
        'notified_100',
    ];

    /**
     * Get the user that owns the budget.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
{
    return $this->hasMany(Expense::class);
}

}
