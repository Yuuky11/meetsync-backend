<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LoginSession extends Model
{
    use HasUuids;

    protected $table = 'login_sessions';

    protected $fillable = [
        'identity_id',
        'device_id',
        'expires_at',
    ];

    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}