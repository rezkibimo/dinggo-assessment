<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarQuoteController;

// Home page: Display the car list
Route::get('/', [CarController::class, 'index']);

// Quotes page: Handle form submissions to get quotes
Route::post('/quotes', [CarQuoteController::class, 'getQuotes']);
