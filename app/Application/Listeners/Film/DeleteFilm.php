<?php

namespace App\Application\Listeners\Film;

use App\Domain\Events\Category\CategoryDeleted;
use App\Domain\Repositories\IFilmRepositoryNeo;

class DeleteFilm
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
    public function handle(CategoryDeleted $event): void
    {
        $this->filmRepository->delete($event->categoryId);
    }
}
