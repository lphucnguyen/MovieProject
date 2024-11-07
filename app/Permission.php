<?php

namespace App;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use HasUuids;

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function (Permission $permission) {
            $permission->id = str()->uuid();
        });
    }
}
