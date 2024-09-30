<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'index']); // Index page showing car list
Route::post('/quotes', [CarController::class, 'getQuotes']); // Quotes page
