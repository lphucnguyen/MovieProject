<?php

namespace App\Application\Commands\Admin;

use App\Application\DTOs\Admin\UpdateAdminDTO;

class UpdateAdminCommand
{
    public function __construct(
        public string $uuid,
        public UpdateAdminDTO $data
    ) {
    }
}
