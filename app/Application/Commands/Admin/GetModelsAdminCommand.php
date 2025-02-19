<?php

namespace App\Application\Commands\Admin;

class GetModelsAdminCommand
{
    public function __construct(
        public string $adminId,
    ) {
    }
}
