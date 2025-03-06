<?php

namespace App;

use App\Traits\ExtendedModel;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use ExtendedModel;

    protected $table = 'ratings';

    protected $keyType = 'string';

    protected $fillable = ['user_id', 'film_id', 'rating'];

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
