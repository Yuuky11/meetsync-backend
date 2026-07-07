<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Device extends Model
{
    use HasUuids;

    protected $fillable = [
        'device_name',
        'platform',
    ];

    public function LoginSession()
    {
        return $this->hasMany(LoginSession::class);
    }
}