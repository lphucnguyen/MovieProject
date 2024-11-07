<?php

namespace App\Commands\Message;

class GetMessagesCommand
{
    public function __construct(
        public string|null $searchKey = null
    ) {
    }
}
