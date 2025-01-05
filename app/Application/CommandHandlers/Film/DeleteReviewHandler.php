<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\DeleteReviewCommand;
use App\Domain\Repositories\IFilmRepository;

class DeleteReviewHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(DeleteReviewCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->deleteReview(
            auth()->user()
        );

        return $film;
    }
}
