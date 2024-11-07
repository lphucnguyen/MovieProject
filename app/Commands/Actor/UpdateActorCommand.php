<?php

namespace App\Commands\Actor;

use App\DTOs\Actor\UpdateActorDTO;

class UpdateActorCommand
{
    public function __construct(
        public string $uuid,
        public UpdateActorDTO $data
    ) {
    }
}
