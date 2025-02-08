<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetOrderCommand;
use App\Domain\Repositories\IOrderRepository;

class GetOrderHandler
{
    public function __construct(
        private IOrderRepository $repository
    ) {
    }

    public function handle(GetOrderCommand $command)
    {
        return $this->repository->get($command->uuid);
    }
}
