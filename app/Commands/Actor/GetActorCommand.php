<?php

namespace App\Commands\Actor;

class GetActorCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
