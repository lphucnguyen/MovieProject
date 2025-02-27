<?php

namespace App\Application\Commands\User;

class GetUserCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
