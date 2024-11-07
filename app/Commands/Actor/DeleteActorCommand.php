<?php

namespace App\Commands\Actor;

class DeleteActorCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
