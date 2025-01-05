<?php

namespace App\Application\DTOs\Actor;

use App\Domain\Models\Actor;
use App\Application\DTOs\BaseDTO;

class GetActorWithFilmsDTO extends BaseDTO
{
    public array $films;
    public Actor $actor;
}
