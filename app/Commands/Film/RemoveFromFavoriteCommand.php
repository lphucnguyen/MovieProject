<?php

namespace App\Commands\Film;

class RemoveFromFavoriteCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
