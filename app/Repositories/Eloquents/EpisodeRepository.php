<?php

namespace App\Repositories\Eloquents;

use App\Episode;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IEpisodeRepository;

class EpisodeRepository extends BaseRepository implements IEpisodeRepository
{
    public function __construct(Episode $model)
    {
        parent::__construct($model);
    }
}
