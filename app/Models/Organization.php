<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Organization extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'organizations';

    protected $fillable = [
        'owner_identity_id',
        'name',
        'slug',
        'description',
        'logo_url',
        'status',
    ];

    protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function owner()
    {
        return $this->belongsTo(Identity::class, 'owner_identity_id');
    }
}