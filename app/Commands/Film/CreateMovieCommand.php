<?php

namespace App\Commands\Film;

use App\DTOs\Film\CreateMovieDTO;

class CreateMovieCommand
{
    public function __construct(
        public CreateMovieDTO $data
    ) {
    }
}
