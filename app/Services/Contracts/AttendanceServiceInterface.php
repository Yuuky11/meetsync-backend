<?php

namespace App\Services\Contracts;

use App\Http\Requests\AttendanceRequest;

interface AttendanceServiceInterface
{
    public function checkIn(AttendanceRequest $request);
}