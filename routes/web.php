<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\CityController::class, 'create'])->name('cities.create');
Route::post('/cities/store', [\App\Http\Controllers\CityController::class, 'store'])->name('cities.store');
