<?php

namespace App\Commands\Message;

class DeleteMessageCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
