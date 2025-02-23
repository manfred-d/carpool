<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'capacity',
        'license_plate',
        'color',
        'user_id',
        'car_model_id',
        'status'

    ];
    public function owner(){
        return $this->belongsTo(User::class);
    }
}
