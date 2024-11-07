<?php

namespace App\Commands\Review;

class DeleteReviewCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
