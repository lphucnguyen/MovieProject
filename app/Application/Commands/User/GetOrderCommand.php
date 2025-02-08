<?php

namespace App\Application\Commands\User;

class GetOrderCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
