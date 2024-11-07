<?php

namespace App\CommandHandlers\Rating;

use App\Commands\Rating\GetRatingsCommand;
use App\Repositories\Contracts\IRatingRepository;

class GetRatingsHandler
{
    public function __construct(
        private IRatingRepository $repository
    ) {
    }

    public function handle(GetRatingsCommand $command)
    {
        $queryParam = $command->queryParam;

        return $this->repository->getRatingsByQueryParams($queryParam->toArray());
    }
}
