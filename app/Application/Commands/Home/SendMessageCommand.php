<?php

namespace App\Application\Commands\Home;

use App\Application\DTOs\Home\SendMessageDTO;

class SendMessageCommand
{
    public function __construct(
        public SendMessageDTO $data
    ) {
    }
}
