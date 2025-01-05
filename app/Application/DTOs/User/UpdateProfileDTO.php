<?php

namespace App\Application\DTOs\User;

use App\Application\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateProfileDTO extends BaseDTO
{
    public string $first_name;
    public string $last_name;
    public UploadedFile $avatar;
}
