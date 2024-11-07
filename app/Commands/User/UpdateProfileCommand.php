<?php

namespace App\Commands\User;

use App\DTOs\User\UpdateProfileDTO;

class UpdateProfileCommand
{
    public function __construct(
        public string $uuid,
        public UpdateProfileDTO $data
    ) {
    }
}
