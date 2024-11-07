<?php

namespace App\Commands\Admin;

use App\DTOs\Admin\CreateAdminDTO;

class CreateAdminCommand
{
    public function __construct(
        public CreateAdminDTO $data
    ) {
    }
}
