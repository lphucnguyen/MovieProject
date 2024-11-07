<?php

namespace App\DTOs\Admin;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CreateAdminDTO extends BaseDTO
{
    public string $name;
    public string $email;
    public string $password;
    public UploadedFile|string $avatar;
    public array $permissions;
}
