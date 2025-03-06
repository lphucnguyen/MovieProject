<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasUuids;

    protected $table = 'messages';

    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'title',
        'message'
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function (Message $model) {
            $model->id = str()->uuid();
        });
    }
}
