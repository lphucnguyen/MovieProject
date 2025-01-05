<?php

namespace App\Application\Commands\Film;

use App\Application\DTOs\Film\CreateMovieDTO;

class CreateMovieCommand
{
    public function __construct(
        public CreateMovieDTO $data
    ) {
    }
}
