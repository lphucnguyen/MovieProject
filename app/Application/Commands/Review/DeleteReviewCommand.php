<?php

namespace App\Application\Commands\Review;

class DeleteReviewCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
