<?php

namespace App\Commands\User;

use App\DTOs\User\CreateUserDTO;

class UpdateUserCommand
{
    public function __construct(
        public string $uuid,
        public CreateUserDTO $data
    ) {
    }
}
