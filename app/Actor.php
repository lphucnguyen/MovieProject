<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Actor extends Model
{
    protected $table = 'actors';

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'dob',
        'avatar',
        'background_cover',
        'overview',
        'biography'
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function (Actor $actor) {
            $attributes = $actor->getAttributes();
            Storage::delete($attributes['background_cover']);
            Storage::delete($attributes['avatar']);
        });

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function getAvatarAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getBackgroundCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_actor');
    }
}
