<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'passenger_id',
        'status',
        'seats_booked',
        'booked_at'
    ];

    public function ride(){
        return $this->belongsTo(Rides::class);
    }

    public function passenger(){
        return $this->belongsTo(User::class, 'passenger_id');
    }
}
