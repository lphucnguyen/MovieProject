<?php

namespace App\Application\Commands\Film;

class AddToFavoriteCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
