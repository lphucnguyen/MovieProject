<?php

namespace App\Application\DTOs\User;

use App\Shared\Application\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CreateUserDTO extends BaseDTO
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $username;
    public string $password;
    public UploadedFile|string $avatar;
}
