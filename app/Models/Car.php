<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'license_plate',
        'license_state',
        'vin',
        'year',
        'colour',
        'make',
        'model',
    ];

    /**
     * Get the quotes for the car.
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
