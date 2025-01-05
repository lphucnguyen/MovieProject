<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasUuids;

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
