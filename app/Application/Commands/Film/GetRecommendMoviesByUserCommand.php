<?php

namespace App\Application\Commands\Film;

class GetRecommendMoviesByUserCommand
{
    public function __construct(
        public string $userId
    ) {
    }
}
