<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateProfileDTO extends BaseDTO
{
    public string $first_name;
    public string $last_name;
    public UploadedFile $avatar;
}
