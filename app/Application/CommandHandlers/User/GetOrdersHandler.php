<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetOrdersCommand;
use App\Domain\Repositories\IUserRepository;

class GetOrdersHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetOrdersCommand $command)
    {
        return $this->repository->getOrders($command->userId);
    }
}
