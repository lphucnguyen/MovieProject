<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use HasUuids;

    protected $table = 'admins';

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::boot();

        // static::deleting(function (Admin $admin) {
        //     $attributes = $admin->getAttributes();
        //     if (isset($attributes['avatar']) && $attributes['avatar']) {
        //         Storage::delete($attributes['avatar']);
        //     }
        // });

        static::creating(function (Admin $model) {
            $model->id = str()->uuid();
        });
    }

    public function getAvatarAttribute($value)
    {
        return asset($value ? 'storage/' . $value : '/images/default.png');
    }
}
