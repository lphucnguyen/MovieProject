<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'orders';

    protected $keyType = 'string';

    protected $fillable = [
        'amount',
        'currency',
        'user_id',
        'payment_name',
        'status',
        'plan_id',
        'transaction_id',
        'paid_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'paid_at' => 'datetime'
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

    public function olderThan(int $minutes)
    {
        return $this->created_at->lt(now()->subMinutes($minutes));
    }
}
