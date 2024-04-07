<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';

    protected $keyType = 'string';

    protected $fillable = ['email', 'title', 'message'];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }
}
