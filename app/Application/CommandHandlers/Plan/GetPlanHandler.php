<?php

namespace App\Application\CommandHandlers\Plan;

use App\Application\Commands\Plan\GetPlanCommand;
use App\Domain\Repositories\IPlanRepository;

class GetPlanHandler
{
    public function __construct(
        public IPlanRepository $repository
    ) {
    }

    public function handle(GetPlanCommand $command)
    {
        return $this->repository->get($command->uuid);
    }
}
