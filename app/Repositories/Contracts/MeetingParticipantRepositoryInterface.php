<?php

namespace App\Repositories\Contracts;

use App\Models\MeetingParticipant;

interface MeetingParticipantRepositoryInterface
{
    public function create(array $data): MeetingParticipant;
    public function findParticipant(string $meetingId, string $identityId);
    public function exists(string $meetingId, string $identityId): bool;
}