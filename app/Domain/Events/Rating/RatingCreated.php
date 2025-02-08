<?php

namespace App\Domain\Events\Rating;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RatingCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $filmId,
        public string $userId,
        public string $rating,
    ) {
    }
}
