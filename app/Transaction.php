<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $keyType = 'string';

    protected $fillable = [
        'trans_id',
        'method_payment',
        'expired_at',
        'user_id',
    ];

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
}
