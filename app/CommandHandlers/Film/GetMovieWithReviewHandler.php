<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\GetMovieWithReviewCommand;
use App\DTOs\Film\GetMovieWithReviewDTO;
use App\Repositories\Contracts\IFilmRepository;

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
