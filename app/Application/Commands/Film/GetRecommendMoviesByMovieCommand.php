<?php

namespace App\Application\Commands\Film;

class GetRecommendMoviesByMovieCommand
{
    public function __construct(
        public string $filmId
    ) {
    }
}
