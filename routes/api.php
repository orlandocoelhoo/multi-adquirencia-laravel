<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;

Route::prefix('v1')->group(function () {
    Route::post('tenancy/register', [RegisterController::class, 'registerTenancy']);
    Route::post('users/register', [RegisterController::class, 'registerUser']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('payment', [PaymentController::class, 'process']);
    });
});

