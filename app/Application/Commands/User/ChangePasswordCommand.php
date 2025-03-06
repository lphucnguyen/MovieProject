<?php

namespace App\Application\Commands\User;

class ChangePasswordCommand
{
    public function __construct(
        public string $uuid,
        public string $password
    ) {
    }
}
