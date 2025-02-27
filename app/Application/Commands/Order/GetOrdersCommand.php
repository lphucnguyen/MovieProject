<?php

namespace App\Application\Commands\Order;

use App\Application\DTOs\Order\GetOrdersDTO;

class GetOrdersCommand
{
    public function __construct(
        public GetOrdersDTO $queryParam
    ) {
    }
}