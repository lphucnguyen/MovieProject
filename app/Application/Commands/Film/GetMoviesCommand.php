<?php

namespace App\Application\Commands\Film;

use App\Application\DTOs\Film\GetMoviesDTO;

class GetMoviesCommand
{
    public function __construct(
        public GetMoviesDTO $queryParam
    ) {
    }
}
