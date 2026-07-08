<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganizationController;

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile', [AuthController::class, 'profile']);

        Route::post('/logout', [AuthController::class, 'logout']);

    });

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::get('/organizations', [OrganizationController::class, 'index']);
});