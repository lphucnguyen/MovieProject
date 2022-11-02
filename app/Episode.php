<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';

    protected $fillable = ['url', 'api_url'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
