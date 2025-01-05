<?php

namespace App\Application\Commands\User;

class GetTransactionsCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
