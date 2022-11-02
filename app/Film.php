<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    //
    use favoritable, rateable, reviewable, ExtendedModel;

    protected $table = 'films';

    protected $fillable = ['name', 'year', 'overview', 'background_cover', 'poster', 'is_free', 'memberships_can_see'];

    protected static function booted()
    {
        static::deleting(function (Film $film) {
            $attributes = $film->getAttributes();
            Storage::delete($attributes['background_cover']);
            Storage::delete($attributes['poster']);
        });
    }

    public function getPosterAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getBackgroundCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'film_category');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor');
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

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function users_rated()
    {
        return $this->belongsToMany(User::class, 'ratings', 'film_id', 'user_id')
                    ->withPivot('rating');
    }
}
