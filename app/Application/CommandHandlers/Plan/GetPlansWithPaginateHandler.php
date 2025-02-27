<?php

namespace App\Application\CommandHandlers\Plan;

use App\Application\Commands\Plan\GetPlansWithPaginateCommand;
use App\Domain\Repositories\IPlanRepository;

class GetPlansWithPaginateHandler
{
    public function __construct(
        public IPlanRepository $repository
    ) {
    }

    public function handle(GetPlansWithPaginateCommand $command)
    {
        return $this->repository->paginate(config('app.perPage'));
    }
}
