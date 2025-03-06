<?php

namespace App\Application\DTOs\Film;

use App\Shared\Application\DTOs\BaseDTO;

class GetMoviesDTO extends BaseDTO
{
    public string|null $searchKey = null;
    public array|string|null $searchKeyCategory = null;
    public array|string|null $searchKeyActor = null;
    public array|string|null $searchKeyFavorite = null;
}
