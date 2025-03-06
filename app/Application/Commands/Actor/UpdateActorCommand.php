<?php

namespace App\Application\Commands\Actor;

use App\Application\DTOs\Actor\UpdateActorDTO;

class UpdateActorCommand
{
    public function __construct(
        public string $uuid,
        public UpdateActorDTO $data
    ) {
    }
}
