<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use HasUuids;

    public $guarded = [];

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function (Role $role) {
            $role->id = str()->uuid();
        });
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
