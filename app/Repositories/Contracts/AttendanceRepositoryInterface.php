<?php

namespace App\Repositories\Contracts;

use App\Models\Attendance;

interface AttendanceRepositoryInterface
{
    public function create(array $data): Attendance;

    public function findByMeetingParticipant(string $meetingParticipantId): ?Attendance;
}