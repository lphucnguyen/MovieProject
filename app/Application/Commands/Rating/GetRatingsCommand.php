<?php

namespace App\Application\Commands\Rating;

use App\Application\DTOs\Rating\GetRatingsDTO;

class GetRatingsCommand
{
    public function __construct(
        public GetRatingsDTO $queryParam
    ) {
    }
}
