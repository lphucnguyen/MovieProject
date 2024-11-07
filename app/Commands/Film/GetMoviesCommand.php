<?php

namespace App\Commands\Film;

use App\DTOs\Film\GetMoviesDTO;

class GetMoviesCommand
{
    public function __construct(
        public GetMoviesDTO $queryParam
    ) {
    }
}
