<?php

namespace App\Repositories\Eloquent;

use App\Models\Attendance;
use App\Repositories\Contracts\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function create(array $data): Attendance
    {
        return Attendance::create($data);
    }

    public function findByMeetingParticipant(string $meetingParticipantId): ?Attendance
    {
        return Attendance::query()
            ->firstWhere('meeting_participant_id', $meetingParticipantId);
    }
}