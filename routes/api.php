<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::prefix('v1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('register', [RegisterController::class, 'register']);
    });
});


