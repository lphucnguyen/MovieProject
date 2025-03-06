<?php

namespace App\Application\Listeners\Rating;

use App\Domain\Events\Rating\RatingUpdated;
use App\Domain\Repositories\IRatingRepositoryNeo;

class UpdateRating
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
    public function handle(RatingUpdated $event): void
    {
        $this->ratingRepository->update($event->filmId, $event->userId, $event->rating);
    }
}
