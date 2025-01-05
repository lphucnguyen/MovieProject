<?php

namespace App\Application\DTOs\Home;

use App\Application\DTOs\BaseDTO;

class SendMessageDTO extends BaseDTO
{
    public string $email;
    public string $title;
    public string $message;
}
