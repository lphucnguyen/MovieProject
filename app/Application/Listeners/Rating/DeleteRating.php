<?php

namespace App\Application\Listeners\Rating;

use App\Domain\Events\Rating\RatingDeleted;
use App\Domain\Repositories\IRatingRepositoryNeo;

class DeleteRating
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private IRatingRepositoryNeo $ratingRepository,
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(RatingDeleted $event): void
    {
        $this->ratingRepository->delete($event->userId, $event->filmId);
    }
}
