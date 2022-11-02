<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'memberships';

    protected $fillable = ['title', 'description', 'price', 'time_expired'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
