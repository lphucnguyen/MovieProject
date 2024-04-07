<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IEpisodeRepository;
use App\Services\BaseService;
use App\Services\IService;

class EpisodeService extends BaseService implements IService
{
    public function __construct(IEpisodeRepository $repository)
    {
        parent::__construct($repository);
    }
}
