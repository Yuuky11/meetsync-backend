<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AttendanceRequest;
use App\Services\Contracts\AttendanceServiceInterface;
use App\Repositories\Contracts\MeetingRepositoryInterface;
use App\Repositories\Contracts\AttendanceRepositoryInterface;
use App\Repositories\Contracts\MeetingParticipantRepositoryInterface;
use App\Repositories\Contracts\MeetingQrTokenRepositoryInterface;

class AttendanceService implements AttendanceServiceInterface
{
    public function __construct(
        protected MeetingRepositoryInterface $meetingRepository,
        protected MeetingParticipantRepositoryInterface $meetingParticipantRepository,
        protected AttendanceRepositoryInterface $attendanceRepository,
        protected MeetingQrTokenRepositoryInterface $meetingQrTokenRepository
    ) {
    }

    public function checkIn(AttendanceRequest $request)
    {
        // Cari QR Token
        $qrToken = $this->meetingQrTokenRepository
            ->findByToken($request->token);

        if (!$qrToken) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid.',
            ], 404);
        }

        // Ambil Meeting dari QR Token
        $meeting = $qrToken->meeting;

        // Waktu sekarang
        $now = Carbon::now();

        // Cek QR expired
        if ($now->greaterThan(Carbon::parse($qrToken->expired_at))) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code sudah kadaluarsa.',
            ], 400);
        }

        // Cek Meeting selesai
        if ($now->greaterThan(Carbon::parse($meeting->end_at))) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting telah selesai.',
            ], 400);
        }

        // Cari Participant
        $participant = $this->meetingParticipantRepository->findParticipant(
            $meeting->id,
            Auth::id()
        );

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Anda bukan peserta meeting.',
            ], 403);
        }

        // Sudah pernah absen?
        $attendance = $this->attendanceRepository
            ->findByMeetingParticipant($participant->id);

        if ($attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absensi.',
            ], 409);
        }

        // Tentukan status hadir
        $lateLimit = Carbon::parse($meeting->start_at)
            ->addMinutes(10);

        $status = $now->greaterThan($lateLimit)
            ? 'LATE'
            : 'PRESENT';

        // Simpan attendance
        $attendance = $this->attendanceRepository->create([
            'meeting_participant_id' => $participant->id,
            'check_in_at' => $now,
            'attendance_status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil.',
            'data' => $attendance,
        ], 201);
    }
}