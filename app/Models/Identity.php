<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Identity extends Authenticatable
{
    use HasApiTokens, HasUuids, SoftDeletes, Notifiable;

    protected $table = 'identities';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'photo_url',
        'status',
    ];

    protected $hidden = [];

   

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function credential()
    {
        return $this->hasOne(Credential::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function loginSessions()
    {
        return $this->hasMany(LoginSession::class);
    }

    public function organizations()
{
    return $this->hasMany(Organization::class, 'owner_identity_id');
}
        public function organizationMembers()
{
    return $this->hasMany(OrganizationMember::class);
}

        public function meetings()
{
    return $this->hasMany(Meeting::class, 'created_by');
}
}