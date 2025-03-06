<?php

namespace App\Application\Commands\Actor;

class DeleteActorCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
