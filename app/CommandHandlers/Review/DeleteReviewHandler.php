<?php

namespace App\CommandHandlers\Review;

use App\Commands\Review\DeleteReviewCommand;
use App\Repositories\Contracts\IReviewRepository;

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
