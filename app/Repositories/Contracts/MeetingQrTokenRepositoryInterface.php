<?php

namespace App\Repositories\Contracts;

use App\Models\MeetingQrToken;

interface MeetingQrTokenRepositoryInterface
{
    public function create(array $data): MeetingQrToken;

    public function findActiveToken(string $meetingId): ?MeetingQrToken;

    public function deactivateByMeeting(string $meetingId): void;

    public function findByToken(string $token): ?MeetingQrToken;

    public function findActiveByMeeting(string $meetingId): ?MeetingQrToken;
}