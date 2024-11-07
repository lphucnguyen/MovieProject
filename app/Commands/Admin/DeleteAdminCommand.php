<?php

namespace App\Commands\Admin;

class DeleteAdminCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
