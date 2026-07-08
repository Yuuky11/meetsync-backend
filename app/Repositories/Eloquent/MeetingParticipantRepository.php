<?php

namespace App\Repositories\Eloquent;

use App\Models\MeetingParticipant;
use App\Repositories\Contracts\MeetingParticipantRepositoryInterface;

class MeetingParticipantRepository implements MeetingParticipantRepositoryInterface
{
    public function create(array $data): MeetingParticipant
    {
        return MeetingParticipant::create($data);
    }

    public function findParticipant(string $meetingId, string $identityId)
{
    return MeetingParticipant::query()
        ->where('meeting_id', $meetingId)
        ->where('identity_id', $identityId)
        ->first();
}
            public function exists(string $meetingId, string $identityId): bool
{
    return MeetingParticipant::query()
        ->where('meeting_id', $meetingId)
        ->where('identity_id', $identityId)
        ->exists();
}
}