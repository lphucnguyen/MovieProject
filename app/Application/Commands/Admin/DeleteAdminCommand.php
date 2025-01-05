<?php

namespace App\Application\Commands\Admin;

class DeleteAdminCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
