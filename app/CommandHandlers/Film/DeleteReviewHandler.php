<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\DeleteReviewCommand;
use App\Repositories\Contracts\IFilmRepository;

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
