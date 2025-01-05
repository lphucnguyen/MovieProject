<?php

namespace App\Application\Commands\Actor;

class GetActorCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
