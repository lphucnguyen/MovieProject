<?php

namespace App\Application\Listeners\Film;

use App\Domain\Events\Film\FilmCreated;
use App\Domain\Repositories\IFilmRepositoryNeo;

class CreateFilm
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private IFilmRepositoryNeo $filmRepository,
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(FilmCreated $event): void
    {
        $fileNameOfBackgoudCover = basename($event->backgroundCover);
        $fileNameOfPoster = basename($event->poster);

        $this->filmRepository->create([
            'id' => $event->filmId,
            'background_cover' => "/film_background_covers/$fileNameOfBackgoudCover",
            'name' => $event->name,
            'overview' => $event->overview,
            'poster' => "/film_posters/$fileNameOfPoster"
        ]);
    }
}
