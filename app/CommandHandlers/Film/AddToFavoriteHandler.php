<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\AddToFavoriteCommand;
use App\Repositories\Contracts\IFilmRepository;

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
