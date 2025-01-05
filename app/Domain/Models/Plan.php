<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'plans';

    protected $keyType = 'string';

    protected $fillable = [
        'slug',
        'price',
        'duration_in_days',
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getVisualPriceAttribute()
    {
        return '$' . number_format($this->price / 100, 2, '.', ',');
    }
}
