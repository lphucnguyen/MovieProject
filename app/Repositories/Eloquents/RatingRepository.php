<?php

namespace App\Repositories\Eloquents;

use App\Rating;
use App\Repositories\BaseRepository;

class RatingRepository extends BaseRepository
{
    public function __construct(Rating $model)
    {
        parent::__construct($model);
    }
}
