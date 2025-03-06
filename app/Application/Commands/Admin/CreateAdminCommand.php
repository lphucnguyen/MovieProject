<?php

namespace App\Application\Commands\Admin;

use App\Application\DTOs\Admin\CreateAdminDTO;

class CreateAdminCommand
{
    public function __construct(
        public CreateAdminDTO $data
    ) {
    }
}
