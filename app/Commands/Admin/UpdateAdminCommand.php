<?php

namespace App\Commands\Admin;

use App\DTOs\Admin\UpdateAdminDTO;

class UpdateAdminCommand
{
    public function __construct(
        public string $uuid,
        public UpdateAdminDTO $data
    ) {
    }
}
