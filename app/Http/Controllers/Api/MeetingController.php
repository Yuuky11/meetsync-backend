<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMeetingRequest;
use App\Services\Contracts\MeetingServiceInterface;
use App\Http\Requests\AddMeetingParticipantRequest;

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
    public function addParticipants(AddMeetingParticipantRequest $request)
{
    return $this->meetingService->addParticipants($request);
}

public function publish(string $meetingId)
{
    return $this->meetingService->publish($meetingId);
}

        public function qr(string $meetingId)
{
    return $this->meetingService->getQrToken($meetingId);
}
}