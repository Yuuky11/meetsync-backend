<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Credential extends Model
{
    use HasUuids;

    protected $table = 'credentials';

    protected $fillable = [
        'identity_id',
        'provider',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}