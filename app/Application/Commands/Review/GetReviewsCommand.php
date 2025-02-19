<?php

namespace App\Application\Commands\Review;

class GetReviewsCommand
{
    public function __construct(
        public string|null $searchKey = null,
        public string|null $client = null
    ) {
    }
}
