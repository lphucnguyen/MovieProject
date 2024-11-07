<?php

namespace App\DTOs\Actor;

use App\Actor;
use App\DTOs\BaseDTO;

class GetActorWithFilmsDTO extends BaseDTO
{
    public array $films;
    public Actor $actor;
}
