<?php

namespace App\Commands\User;

class GetRatingsCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
