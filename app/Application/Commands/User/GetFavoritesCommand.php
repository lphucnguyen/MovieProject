<?php

namespace App\Application\Commands\User;

class GetFavoritesCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
