<?php

namespace App\Application\CommandHandlers\Order;

use App\Application\Commands\Order\GetOrdersCommand;
use App\Domain\Repositories\IOrderRepository;

class GetOrdersHandler
{
    public function __construct(
        public IOrderRepository $repository
    ) {
    }

    public function handle(GetOrdersCommand $command)
    {
        return $this->repository->getOrdersByQueryParams($command->queryParam->toArray());
    }
}
