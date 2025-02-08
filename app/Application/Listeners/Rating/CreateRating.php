<?php

namespace App\Application\Listeners\Rating;

use App\Domain\Events\Rating\RatingCreated;
use App\Domain\Repositories\IRatingRepositoryNeo;

class CreateRating
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
    public function handle(RatingCreated $event): void
    {
        $this->ratingRepository->create($event->filmId, $event->userId, $event->rating);
    }
}
