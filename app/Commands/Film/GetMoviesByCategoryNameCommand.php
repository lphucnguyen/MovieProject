<?php

namespace App\Commands\Film;

class GetMoviesByCategoryNameCommand
{
    public function __construct(
        public array|string|null $categories
    ) {
    }
}
