<?php

namespace App\Repositories\Eloquents;

use App\Repositories\BaseRepository;
use App\Review;

class ReviewRepository extends BaseRepository
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}
