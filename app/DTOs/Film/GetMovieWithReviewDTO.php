<?php

namespace App\DTOs\Film;

use App\DTOs\BaseDTO;

class GetMovieWithReviewDTO extends BaseDTO
{
    public $film;
    public $reviews;
}
