<?php

namespace App\Commands\Review;

class GetReviewsCommand
{
    public function __construct(
        public string|null $searchKey = null
    ) {
    }
}
