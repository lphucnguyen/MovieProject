<?php

namespace App\Application\Commands\User;

use App\Application\DTOs\User\UpdateUserDTO;

class UpdateUserCommand
{
    public function __construct(
        public string $uuid,
        public UpdateUserDTO $data
    ) {
    }
}
