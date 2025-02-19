<?php

namespace App\Application\DTOs\Admin;

use App\Shared\Application\DTOs\BaseDTO;

class CreateAdminDTO extends BaseDTO
{
    public string $name;
    public string $email;
    public string $password;
    public string $avatar;
    public array $permissions;
}
