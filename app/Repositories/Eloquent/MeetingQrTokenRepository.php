<?php

namespace App\Repositories\Eloquent;

use App\Models\MeetingQrToken;
use App\Repositories\Contracts\MeetingQrTokenRepositoryInterface;

class MeetingQrTokenRepository implements MeetingQrTokenRepositoryInterface
{
    public function create(array $data): MeetingQrToken
    {
        return MeetingQrToken::create($data);
    }

    public function findActiveToken(string $meetingId): ?MeetingQrToken
    {
        return MeetingQrToken::query()
            ->where('meeting_id', $meetingId)
            ->where('is_active', true)
            ->first();
    }

    public function deactivateByMeeting(string $meetingId): void
    {
        MeetingQrToken::query()
            ->where('meeting_id', $meetingId)
            ->update([
                'is_active' => false
            ]);
    }

    public function findByToken(string $token): ?MeetingQrToken
    {
        return MeetingQrToken::query()
            ->where('token', $token)
            ->where('is_active', true)
            ->first();
    }

    public function findActiveByMeeting(string $meetingId): ?MeetingQrToken
{
    return MeetingQrToken::query()
        ->where('meeting_id', $meetingId)
        ->where('is_active', true)
        ->first();
}
}