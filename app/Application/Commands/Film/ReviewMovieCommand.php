<?php

namespace App\Application\Commands\Film;

class ReviewMovieCommand
{
    public function __construct(
        public string $uuid,
        public string $title,
        public string $review
    ) {
    }
}
