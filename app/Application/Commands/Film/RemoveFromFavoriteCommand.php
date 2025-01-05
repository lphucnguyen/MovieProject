<?php

namespace App\Application\Commands\Film;

class RemoveFromFavoriteCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
