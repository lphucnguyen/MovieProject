<?php

namespace App\DTOs\Review;

use App\DTOs\BaseDTO;

class GetReviewsDTO extends BaseDTO
{
    public string|null $searchKey = null;
    public array|string|null $searchRating = null;
}
