<?php

namespace App\Application\CommandHandlers\Category;

use App\Application\Commands\Category\GetCategoryCommand;
use App\Domain\Repositories\ICategoryRepository;

class GetCategoryHandler
{
    public function __construct(
        private ICategoryRepository $repository
    ) {
    }

    public function handle(GetCategoryCommand $command)
    {
        return $this->repository->getCategoriesByQueryParams([
            'searchKey' => $command->searchKey
        ]);
    }
}
