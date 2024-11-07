<?php

namespace App\Commands\User;

use App\DTOs\User\CreateUserDTO;

class CreateUserCommand
{
    public function __construct(
        public CreateUserDTO $data
    ) {
    }
}
