<?php

namespace App\Repositories\Eloquents;

use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
