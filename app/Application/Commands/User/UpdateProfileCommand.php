<?php

namespace App\Application\Commands\User;

use App\Application\DTOs\User\UpdateProfileDTO;

class UpdateProfileCommand
{
    public function __construct(
        public string $uuid,
        public UpdateProfileDTO $data
    ) {
    }
}
