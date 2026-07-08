<?php

namespace App\Services;

use App\Http\Requests\CreateMeetingRequest;
use App\Repositories\Contracts\MeetingRepositoryInterface;
use App\Services\Contracts\MeetingServiceInterface;

use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;
use App\Repositories\Contracts\OrganizationMemberRepositoryInterface;

class MeetingService implements MeetingServiceInterface
{
    public function __construct(
    protected MeetingRepositoryInterface $meetingRepository,
    protected OrganizationMemberRepositoryInterface $organizationMemberRepository
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

    return response()->json([
        'success' => true,
        'message' => 'Meeting berhasil dibuat.',
        'data' => $meeting,
    ], 201);
}
}