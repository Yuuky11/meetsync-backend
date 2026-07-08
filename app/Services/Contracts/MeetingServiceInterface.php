<?php

namespace App\Services\Contracts;

use App\Http\Requests\CreateMeetingRequest;

interface MeetingServiceInterface
{
    public function create(CreateMeetingRequest $request);
}