<?php

namespace App\Domain\Events\Film;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilmCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $filmId,
        public string $name,
        public string $overview,
        public string $poster,
        public string $backgroundCover
    ) {
    }
}
