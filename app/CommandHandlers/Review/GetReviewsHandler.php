<?php

namespace App\CommandHandlers\Review;

use App\Commands\Review\GetReviewsCommand;
use App\Repositories\Contracts\IReviewRepository;

class GetReviewsHandler
{
    public function __construct(
        public IReviewRepository $repository
    ) {
    }

    public function handle(GetReviewsCommand $command)
    {
        return $this->repository->getReviewByQueryParams([
            'searchKey' => $command->searchKey,
        ]);
    }
}
