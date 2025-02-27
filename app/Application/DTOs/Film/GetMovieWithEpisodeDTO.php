<?php

namespace App\Application\DTOs\Film;

use App\Shared\Application\DTOs\BaseDTO;

class GetMovieWithEpisodeDTO extends BaseDTO
{
    public $film;
    public $episodes;
}
