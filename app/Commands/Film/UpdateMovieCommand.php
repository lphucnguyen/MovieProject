<?php

namespace App\Commands\Film;

use App\DTOs\Film\UpdateMovieDTO;

class UpdateMovieCommand
{
    public function __construct(
        public string $uuid,
        public UpdateMovieDTO $data
    ) {
    }
}
