<?php

namespace App\Commands\User;

class GetFavoritesCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
