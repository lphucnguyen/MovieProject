<?php

namespace App\CommandHandlers\Category;

use App\Commands\Category\CreateCategoryCommand;
use App\Repositories\Contracts\ICategoryRepository;

class CreateCategoryHandler
{
    public function __construct(
        private ICategoryRepository $repository
    ) {
    }

    public function handle(CreateCategoryCommand $command)
    {
        $this->repository->create($command->data->toArray());
    }
}
