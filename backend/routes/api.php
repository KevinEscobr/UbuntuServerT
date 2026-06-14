<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\DriverController;

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/products', [ClientController::class, 'products']);

    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        // Client module
        Route::post('/orders', [ClientController::class, 'store']);
        Route::get('/orders/{id}/track', [ClientController::class, 'track']);

        // Admin module
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard']);
            Route::put('/orders/{id}', [AdminController::class, 'update']);
            Route::delete('/orders/{id}', [AdminController::class, 'destroy']);
            Route::post('/orders/{id}/assign', [AdminController::class, 'assign']);
        });

        // Driver module
        Route::prefix('driver')->group(function () {
            Route::get('/orders', [DriverController::class, 'index']);
            Route::get('/orders/history', [DriverController::class, 'history']);
            Route::post('/location', [DriverController::class, 'updateLocation']);
            Route::post('/orders/{id}/complete', [DriverController::class, 'complete']);
        });
    });
});