<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Episode;

use App\Domain\Repositories\IEpisodeRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class EpisodeRepository extends BaseRepository implements IEpisodeRepository
{
    public function __construct(
        private Episode $model
    ) {
        parent::__construct($model);
    }
}
