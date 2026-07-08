<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OrganizationMember extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'organization_members';

    protected $fillable = [
        'organization_id',
        'identity_id',
        'role',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}