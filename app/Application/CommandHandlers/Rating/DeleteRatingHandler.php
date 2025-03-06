<?php

namespace App\Application\CommandHandlers\Rating;

use App\Application\Commands\Rating\DeleteRatingCommand;
use App\Domain\Repositories\IRatingRepository;

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
