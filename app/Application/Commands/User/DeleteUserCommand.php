<?php

namespace App\Application\Commands\User;

class DeleteUserCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
