<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'car_id',
        'price',
        'repairer',
        'overview_of_work',
    ];

    /**
     * Get the car that owns the quote.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
