<?php

namespace App\Commands\Actor;

use App\DTOs\Actor\CreateActorDTO;

class CreateActorCommand
{
    public function __construct(
        public CreateActorDTO $data
    ) {
    }
}
