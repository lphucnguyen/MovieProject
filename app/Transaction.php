<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $table = 'transactions';

    protected $fillable = [
        'trans_id', 'method_payment', 'expired_at', 'user_id', 'membership_id'
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
