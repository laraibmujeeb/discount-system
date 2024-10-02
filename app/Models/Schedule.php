<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'time', 'location'];

    /**
     * A schedule has many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
