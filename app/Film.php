<?php

namespace App;

use App\Traits\ExtendedModel;
use App\Traits\Favoritable;
use App\Traits\Rateable;
use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    use Favoritable;
    use Rateable;
    use Reviewable;
    use ExtendedModel;

    protected $table = 'films';

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'year',
        'overview',
        'background_cover',
        'poster'
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function (Film $film) {
            $attributes = $film->getAttributes();
            Storage::delete($attributes['background_cover']);
            Storage::delete($attributes['poster']);
        });

        static::creating(function ($model) {
            $model->id = str()->uuid();
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
