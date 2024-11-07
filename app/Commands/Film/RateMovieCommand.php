<?php

namespace App\Commands\Film;

class RateMovieCommand
{
    public function __construct(
        public string $uuid,
        public int $rating
    ) {
    }
}
