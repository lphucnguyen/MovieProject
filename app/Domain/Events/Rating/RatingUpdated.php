<?php

namespace App\Domain\Events\Rating;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RatingUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $filmId,
        public string $userId,
        public string $rating,
    ) {
    }
}
