<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ride_id',
        'start_location',
        'end_location',
    ];

    public function ride(){
        return $this->belongsTo(Rides::class);
    }

}
