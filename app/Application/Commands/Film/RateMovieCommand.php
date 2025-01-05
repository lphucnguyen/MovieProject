<?php

namespace App\Application\Commands\Film;

class RateMovieCommand
{
    public function __construct(
        public string $uuid,
        public int $rating
    ) {
    }
}
