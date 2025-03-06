<?php

namespace App\Application\Commands\Order;

class GetOrderCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
