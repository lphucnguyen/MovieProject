<?php

namespace App\Application\DTOs\Actor;

use App\Shared\Application\DTOs\BaseDTO;

class UpdateActorDTO extends BaseDTO
{
    public string $name;
    public string $dob;
    public string $overview;
    public string $biography;
    public string|null $avatar;
    public string|null $background_cover;
}
