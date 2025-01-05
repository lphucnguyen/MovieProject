<?php

namespace App\Application\CommandHandlers\Plan;

use App\Application\Commands\Plan\GetPlansCommand;
use App\Domain\Repositories\IPlanRepository;

class GetPlansHandler
{
    public function __construct(
        public IPlanRepository $repository
    ) {
    }

    public function handle(GetPlansCommand $command)
    {
        return $this->repository->all();
    }
}
