<?php

namespace App\Commands\Film;

class DeleteReviewCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
