<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MeetingParticipant extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'meeting_participants';

    protected $fillable = [
        'meeting_id',
        'identity_id',
        'role',
        'invitation_status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }

    public function attendance()
{
    return $this->hasOne(Attendance::class);
}
}