<?php

namespace App\Commands\Film;

class AddToFavoriteCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
