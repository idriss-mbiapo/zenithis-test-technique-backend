<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrajetController;


Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('trajets', [TrajetController::class, 'index']);
    Route::post('trajets', [TrajetController::class, 'store']);
    Route::put('trajets/{id}', [TrajetController::class, 'update']);
    Route::delete('trajets/{id}', [TrajetController::class, 'destroy']);
});

