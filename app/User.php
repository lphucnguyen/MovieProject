<?php

namespace App;

use App\Traits\ExtendedModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use ExtendedModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'avatar',
        'password',
        'expired_at',
    ];

    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::boot();

        // When the client is being deleted, delete the avatar as well.
        static::deleting(function (User $user) {
            $attributes = $user->getAttributes();
            if (isset($attributes['avatar']) && $attributes['avatar']) {
                Storage::delete($attributes['avatar']);
            }
        });

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function getAvatarAttribute($value)
    {
        return asset($value ? 'storage/' . $value : '/images/default.png');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function rated_films()
    {
        return $this->belongsToMany(Film::class, 'ratings', 'user_id', 'film_id')
                    ->withPivot('rating');
    }
}
