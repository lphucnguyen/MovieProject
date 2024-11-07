<?php

namespace App\CommandHandlers\Rating;

use App\Commands\Rating\DeleteRatingCommand;
use App\Repositories\Contracts\IRatingRepository;

class DeleteRatingHandler
{
    public function __construct(
        private IRatingRepository $repository
    ) {
    }

    public function handle(DeleteRatingCommand $command)
    {
        $rating = $this->repository->get($command->uuid);
        $rating->delete();
    }
}
