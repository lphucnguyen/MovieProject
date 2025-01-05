<?php

namespace App\Application\DTOs\Actor;

use App\Application\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateActorDTO extends BaseDTO
{
    public string $name;
    public string $dob;
    public string $overview;
    public string $biography;
    public UploadedFile|string|null $avatar = null;
    public UploadedFile|string|null $background_cover = null;
}
