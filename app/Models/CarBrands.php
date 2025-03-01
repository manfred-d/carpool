<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrands extends Model
{
    use HasFactory;

    protected $table = 'car_models';

    protected $fillable = [
        'brand',
        'model',
        'description',
        'is_enabled'
    ];

    public function car(){
        return $this->hasMany(Cars::class);
    }
}
