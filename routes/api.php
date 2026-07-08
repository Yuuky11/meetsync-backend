<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Controllers\Api\AttendanceController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Organization
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations/members', [OrganizationController::class, 'addMembers']);

    // Meeting
    Route::post('/meetings', [MeetingController::class, 'store']);
    Route::post('/meetings/participants', [MeetingController::class, 'addParticipants']);
    Route::patch('/meetings/{meetingId}/publish', [MeetingController::class, 'publish']);
    Route::get('/meetings/{meetingId}/qr', [MeetingController::class, 'qr']);

    // Attendance
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);

});