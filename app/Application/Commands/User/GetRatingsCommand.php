<?php

namespace App\Application\Commands\User;

class GetRatingsCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
