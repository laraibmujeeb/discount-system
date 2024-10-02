<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'total_cost',
        'status', // Optional: to track booking status (e.g., confirmed, canceled)
    ];

    /**
     * The booking belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The booking belongs to a schedule (if you have a Schedule model).
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
