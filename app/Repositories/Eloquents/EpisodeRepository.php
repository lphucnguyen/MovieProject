<?php

namespace App\Repositories\Eloquents;

use App\Episode;
use App\Repositories\BaseRepository;

class EpisodeRepository extends BaseRepository
{
    public function __construct(Episode $model)
    {
        parent::__construct($model);
    }
}
