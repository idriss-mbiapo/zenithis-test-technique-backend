<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrajetController;


Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('trajets', [TrajetController::class, 'index']);
    Route::post('trajet/create', [TrajetController::class, 'store']);
    Route::put('trajet/{id}', [TrajetController::class, 'update']);
    Route::delete('trajet/{id}', [TrajetController::class, 'destroy']);
});

