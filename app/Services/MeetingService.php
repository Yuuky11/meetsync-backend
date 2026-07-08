<?php

namespace App\Services;

use App\Http\Requests\CreateMeetingRequest;
use App\Repositories\Contracts\MeetingRepositoryInterface;
use App\Services\Contracts\MeetingServiceInterface;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Repositories\Contracts\MeetingQrTokenRepositoryInterface;

use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;
use App\Repositories\Contracts\OrganizationMemberRepositoryInterface;

use App\Http\Requests\AddMeetingParticipantRequest;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\MeetingParticipantRepositoryInterface;

class MeetingService implements MeetingServiceInterface
{
    public function __construct(
    protected MeetingRepositoryInterface $meetingRepository,
    protected OrganizationMemberRepositoryInterface $organizationMemberRepository,
    protected MeetingParticipantRepositoryInterface $meetingParticipantRepository,
    protected MeetingQrTokenRepositoryInterface $meetingQrTokenRepository
) {
}

    public function create(CreateMeetingRequest $request)
{
    $member = $this->organizationMemberRepository->findMember(
        $request->organization_id,
        Auth::id()
    );

    if (!$member) {
        return response()->json([
            'success' => false,
            'message' => 'Anda bukan anggota organisasi ini.',
        ], 403);
    }

    if (!in_array($member->role, ['OWNER', 'ADMIN'])) {
        return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin membuat meeting.',
        ], 403);
    }

    DB::beginTransaction();

    try {

        $meeting = $this->meetingRepository->create([

            'organization_id' => $request->organization_id,

            'created_by' => Auth::id(),

            'title' => $request->title,

            'description' => $request->description,

            'meeting_type' => $request->meeting_type,

            'start_at' => $request->start_at,

            'end_at' => $request->end_at,

            'status' => 'DRAFT',

        ]);

        $this->meetingParticipantRepository->create([

            'meeting_id' => $meeting->id,

            'identity_id' => Auth::id(),

            'role' => 'HOST',

            'invitation_status' => 'ACCEPTED',

        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Meeting berhasil dibuat.',
            'data' => $meeting,
        ], 201);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function addParticipants(AddMeetingParticipantRequest $request)
{
    $meeting = $this->meetingRepository->findById($request->meeting_id);

    if (!$meeting) {
        return response()->json([
            'success' => false,
            'message' => 'Meeting tidak ditemukan.'
        ], 404);
    }

    $added = [];

    foreach ($request->identity_ids as $identityId) {

        // Cek apakah anggota organisasi
        $member = $this->organizationMemberRepository->findMember(
            $meeting->organization_id,
            $identityId
        );

        if (!$member) {
            continue;
        }

        // Cek apakah sudah menjadi participant
        if ($this->meetingParticipantRepository->exists(
            $meeting->id,
            $identityId
        )) {
            continue;
        }

        $participant = $this->meetingParticipantRepository->create([
            'meeting_id' => $meeting->id,
            'identity_id' => $identityId,
            'role' => 'PARTICIPANT',
            'invitation_status' => 'INVITED',
        ]);

        $added[] = $participant;
    }

    return response()->json([
        'success' => true,
        'message' => 'Peserta berhasil ditambahkan.',
        'data' => $added,
    ]);
}

public function publish(string $meetingId)
{
    $meeting = $this->meetingRepository->findById($meetingId);

    if (!$meeting) {
        return response()->json([
            'success' => false,
            'message' => 'Meeting tidak ditemukan.'
        ], 404);
    }

    if ($meeting->status !== 'DRAFT') {
        return response()->json([
            'success' => false,
            'message' => 'Meeting sudah dipublish atau selesai.'
        ], 400);
    }

    DB::beginTransaction();

    try {

        $meeting = $this->meetingRepository->updateStatus(
            $meetingId,
            'PUBLISHED'
        );

        // Nonaktifkan QR lama (kalau ada)
        $this->meetingQrTokenRepository->deactivateByMeeting($meetingId);

        // Generate QR Token baru
        $qrToken = $this->meetingQrTokenRepository->create([
            'meeting_id' => $meetingId,
            'token' => 'MS_' . Str::random(32),
            'expired_at' => Carbon::parse($meeting->end_at),
            'is_active' => true,
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Meeting berhasil dipublish.',
            'data' => [
                'meeting' => $meeting,
                'qr_token' => $qrToken,
            ],
        ]);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

            public function getQrToken(string $meetingId)
{
    $meeting = $this->meetingRepository->findById($meetingId);

    if (!$meeting) {
        return response()->json([
            'success' => false,
            'message' => 'Meeting tidak ditemukan.'
        ], 404);
    }

    $qrToken = $this->meetingQrTokenRepository
        ->findActiveToken($meetingId);

    if (!$qrToken) {
        return response()->json([
            'success' => false,
            'message' => 'QR Token belum tersedia.'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $qrToken,
    ]);
}
}