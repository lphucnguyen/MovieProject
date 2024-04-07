<?php

namespace App\Repositories\Eloquents;

use App\Actor;
use App\Repositories\BaseRepository;

class ActorRepository extends BaseRepository
{
    public function __construct(Actor $model)
    {
        parent::__construct($model);
    }
}
