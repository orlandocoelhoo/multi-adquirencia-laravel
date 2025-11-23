<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;

Route::prefix('v1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('register', [RegisterController::class, 'register']);
    });
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

