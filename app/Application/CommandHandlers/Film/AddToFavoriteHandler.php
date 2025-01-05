<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\AddToFavoriteCommand;
use App\Domain\Repositories\IFilmRepository;

class AddToFavoriteHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(AddToFavoriteCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->addToFavorite(
            auth()->user()
        );

        return $film;
    }
}
