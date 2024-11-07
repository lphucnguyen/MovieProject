<?php

namespace App\Commands\User;

class GetTransactionsCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
