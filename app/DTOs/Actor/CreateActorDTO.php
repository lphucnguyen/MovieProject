<?php

namespace App\DTOs\Actor;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CreateActorDTO extends BaseDTO
{
    public string $name;
    public string $dob;
    public string $overview;
    public string $biography;
    public UploadedFile $avatar;
    public UploadedFile $background_cover;
}