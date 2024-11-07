<?php

namespace App\Commands\Rating;

use App\DTOs\Rating\GetRatingsDTO;

class GetRatingsCommand
{
    public function __construct(
        public GetRatingsDTO $queryParam
    ) {
    }
}
