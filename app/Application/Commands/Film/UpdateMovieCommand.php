<?php

namespace App\Application\Commands\Film;

use App\Application\DTOs\Film\UpdateMovieDTO;

class UpdateMovieCommand
{
    public function __construct(
        public string $uuid,
        public UpdateMovieDTO $data
    ) {
    }
}
