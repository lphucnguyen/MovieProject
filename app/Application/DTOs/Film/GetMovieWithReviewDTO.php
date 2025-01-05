<?php

namespace App\Application\DTOs\Film;

use App\Application\DTOs\BaseDTO;

class GetMovieWithReviewDTO extends BaseDTO
{
    public $film;
    public $reviews;
}
