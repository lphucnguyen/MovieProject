<?php

namespace App\Commands\Home;

use App\DTOs\Home\SendMessageDTO;

class SendMessageCommand
{
    public function __construct(
        public SendMessageDTO $data
    ) {
    }
}
