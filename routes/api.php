<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cities', [\App\Http\Controllers\Api\CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{id}', [\App\Http\Controllers\Api\CityController::class, 'show'])->name('cities.show');
