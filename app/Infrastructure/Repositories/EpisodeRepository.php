<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Episode;

use App\Domain\Repositories\IEpisodeRepository;

class EpisodeRepository extends BaseRepository implements IEpisodeRepository
{
    public function __construct(Episode $model)
    {
        parent::__construct($model);
    }
}
