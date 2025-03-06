<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';

    protected $keyType = 'string';

    protected $fillable = ['url', 'api_url'];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
