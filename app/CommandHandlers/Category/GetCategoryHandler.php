<?php

namespace App\CommandHandlers\Category;

use App\Commands\Category\GetCategoryCommand;
use App\Repositories\Contracts\ICategoryRepository;

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
