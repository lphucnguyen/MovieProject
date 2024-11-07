<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\RemoveFromFavoriteCommand;
use App\Repositories\Contracts\IFilmRepository;

class RemoveFromFavoriteHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(RemoveFromFavoriteCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->removeFromFavorite(
            auth()->user()
        );

        return $film;
    }
}
