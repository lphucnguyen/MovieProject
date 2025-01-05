<?php

namespace App\Application\Commands\Actor;

use App\Application\DTOs\Actor\CreateActorDTO;

class CreateActorCommand
{
    public function __construct(
        public CreateActorDTO $data
    ) {
    }
}
