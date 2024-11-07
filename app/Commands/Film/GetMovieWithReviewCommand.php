<?php

namespace App\Commands\Film;

class GetMovieWithReviewCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
