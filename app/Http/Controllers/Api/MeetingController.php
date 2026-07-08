<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMeetingRequest;
use App\Services\Contracts\MeetingServiceInterface;

class MeetingController extends Controller
{
    public function __construct(
        protected MeetingServiceInterface $meetingService
    ) {
    }

    public function store(CreateMeetingRequest $request)
    {
        return $this->meetingService->create($request);
    }
}