<?php

namespace App\Application\Commands\Film;

class DeleteReviewCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
