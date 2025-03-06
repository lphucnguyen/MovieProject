<?php

namespace App\Application\DTOs\Admin;

use App\Shared\Application\DTOs\BaseDTO;

class UpdatePermissionsAdminDTO extends BaseDTO
{
    public array $permissions = [];
}
