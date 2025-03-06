<?php

namespace App\Domain\Events\Film;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilmDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $filmId
    ) {
    }
}
