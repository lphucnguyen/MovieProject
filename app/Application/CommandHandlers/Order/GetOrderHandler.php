<?php

namespace App\Application\CommandHandlers\Order;

use App\Application\Commands\Order\GetOrderCommand;
use App\Domain\Repositories\IOrderRepository;

class GetOrderHandler
{
    public function __construct(
        public IOrderRepository $repository
    ) {
    }

    public function handle(GetOrderCommand $command)
    {
        return $this->repository->get($command->uuid);
    }
}
