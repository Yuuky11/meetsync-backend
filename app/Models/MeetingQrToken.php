<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MeetingQrToken extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'meeting_qr_tokens';

    protected $fillable = [
        'meeting_id',
        'token',
        'expired_at',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}