<?php

namespace App\Application\Commands\User;

use App\Application\DTOs\User\CreateUserDTO;

class CreateUserCommand
{
    public function __construct(
        public CreateUserDTO $data
    ) {
    }
}
