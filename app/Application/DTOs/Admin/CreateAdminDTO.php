<?php

namespace App\Application\DTOs\Admin;

use App\Application\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class CreateAdminDTO extends BaseDTO
{
    public string $name;
    public string $email;
    public string $password;
    public UploadedFile|string $avatar;
    public array $permissions;
}
