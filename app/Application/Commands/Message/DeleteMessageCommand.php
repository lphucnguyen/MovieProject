<?php

namespace App\Application\Commands\Message;

class DeleteMessageCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
