<?php

namespace App\Application\CommandHandlers\Review;

use App\Application\Commands\Review\DeleteReviewCommand;
use App\Domain\Repositories\IReviewRepository;

class DeleteReviewHandler
{
    public function __construct(
        public IReviewRepository $repository
    ) {
    }

    public function handle(DeleteReviewCommand $command)
    {
        $this->repository->delete($command->uuid);
    }
}
