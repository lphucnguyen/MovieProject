<?php

namespace App\Application\Commands\User;

class GetOrdersCommand
{
    public function __construct(
        public string $userId,
    ) {
    }
}
