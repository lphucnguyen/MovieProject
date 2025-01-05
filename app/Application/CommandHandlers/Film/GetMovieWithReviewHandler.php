<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\GetMovieWithReviewCommand;
use App\Application\DTOs\Film\GetMovieWithReviewDTO;
use App\Domain\Repositories\IFilmRepository;

class GetMovieWithReviewHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(GetMovieWithReviewCommand $command)
    {
        $uuid = $command->uuid;

        return GetMovieWithReviewDTO::create([
            'film' => $this->repository->get($uuid),
            'reviews' => $this->repository->getReviews($uuid)
        ]);
    }
}
