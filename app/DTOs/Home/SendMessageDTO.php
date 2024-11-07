<?php

namespace App\DTOs\Home;

use App\DTOs\BaseDTO;

class SendMessageDTO extends BaseDTO
{
    public string $email;
    public string $title;
    public string $message;
}
