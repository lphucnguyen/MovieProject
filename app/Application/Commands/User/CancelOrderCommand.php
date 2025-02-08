<?php

namespace App\Application\Commands\User;

class CancelOrderCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
