<?php

namespace App\Application\DTOs\Admin;

use App\Shared\Application\DTOs\BaseDTO;

class UpdateAdminDTO extends BaseDTO
{
    public string|null $name = '';
    public string|null $email = '';
    public string|null $password = '';
    public string|null $avatar = null;
}
