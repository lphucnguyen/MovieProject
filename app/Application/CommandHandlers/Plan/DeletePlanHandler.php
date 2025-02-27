<?php

namespace App\Application\CommandHandlers\Plan;

use App\Application\Commands\Plan\DeletePlanCommand;
use App\Domain\Repositories\IPlanRepository;

class DeletePlanHandler
{
    public function __construct(
        public IPlanRepository $repository
    ) {
    }

    public function handle(DeletePlanCommand $command)
    {
        return $this->repository->delete($command->uuid);
    }
}
