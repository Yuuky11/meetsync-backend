<?php

namespace App\Services\Contracts;

use App\Http\Requests\CreateMeetingRequest;
use App\Http\Requests\AddMeetingParticipantRequest;

interface MeetingServiceInterface
{
    public function create(CreateMeetingRequest $request);
    public function addParticipants(AddMeetingParticipantRequest $request);
    public function publish(string $meetingId);
    public function getQrToken(string $meetingId);
}