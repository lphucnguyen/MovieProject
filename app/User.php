<?php

namespace App;

use App\Traits\ExtendedModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use ExtendedModel;
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'avatar',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::boot();
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

    public function ratedFilms()
    {
        return $this->belongsToMany(Film::class, 'ratings', 'user_id', 'film_id')
                    ->withPivot('rating');
    }
}
