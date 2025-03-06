<?php

namespace App\Application\Commands\Film;

class GetMovieWithReviewCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
