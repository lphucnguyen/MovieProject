<?php

namespace App\Application\Commands\Admin;

use App\Application\DTOs\Admin\UpdatePermissionsAdminDTO;

class UpdatePermissionsAdminCommand
{
    public function __construct(
        public string $uuid,
        public UpdatePermissionsAdminDTO $data
    ) {
    }
}
