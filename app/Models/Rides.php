<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rides extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'car_id',
        'departure_time',
        'end_time',
        'start_location_id',
        'end_location_id',
        'status',
        'price',
        'phone',
        'name',
        'available_seats'
    ];

    public function driver(){
        return $this->belongsTo(User::class, 'driver_id');

    }
    public function car(){
        return $this->belongsTo(Cars::class, 'car_id');
    }
    public function location(){
        return $this->hasOne(Locations::class);
    }
    public function bookings(){
        return $this->hasMany(Bookings::class);
    }
}
