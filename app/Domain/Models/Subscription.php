<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'subscriptions';

    protected $keyType = 'string';

    protected $fillable = [
        'active_until',
        'user_id',
        'plan_id'
    ];

    protected $dates = [
        'active_until',
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

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive()
    {
        return $this->active_until->gt(now());
    }
}
