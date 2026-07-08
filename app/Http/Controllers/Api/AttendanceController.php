<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Services\Contracts\AttendanceServiceInterface;

class AttendanceController extends Controller
{
    public function __construct(
        protected AttendanceServiceInterface $attendanceService
    ) {
    }

    public function checkIn(AttendanceRequest $request)
    {
        return $this->attendanceService->checkIn($request);
    }
}