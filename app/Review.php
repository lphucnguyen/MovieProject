<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';

    protected $keyType = 'string';

    protected $fillable = ['user_id', 'film_id', 'title', 'review'];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
