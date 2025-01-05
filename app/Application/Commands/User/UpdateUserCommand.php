<?php

namespace App\Application\Commands\User;

use App\Application\DTOs\User\CreateUserDTO;

class UpdateUserCommand
{
    public function __construct(
        public string $uuid,
        public CreateUserDTO $data
    ) {
    }
}
