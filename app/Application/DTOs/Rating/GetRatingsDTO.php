<?php

namespace App\Application\DTOs\Rating;

use App\Application\DTOs\BaseDTO;

class GetRatingsDTO extends BaseDTO
{
    public string|null $searchKey = null;
    public string|null $client = null;
    public string|null $film = null;
    public array|string|null $searchRating = null;
}
