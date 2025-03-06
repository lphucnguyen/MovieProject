<?php

namespace App\Application\DTOs\Actor;

use App\Domain\Models\Actor;
use App\Shared\Application\DTOs\BaseDTO;

class GetActorWithFilmsDTO extends BaseDTO
{
    public \Illuminate\Pagination\LengthAwarePaginator $films;
    public Actor $actor;
}
