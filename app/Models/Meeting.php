<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Meeting extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'meetings';

    protected $fillable = [
        'organization_id',
        'created_by',
        'title',
        'description',
        'meeting_type',
        'start_at',
        'end_at',
        'status',
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

    public function creator()
    {
        return $this->belongsTo(Identity::class, 'created_by');
    }
}