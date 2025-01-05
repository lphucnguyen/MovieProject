<?php

namespace App\Application\CommandHandlers\Category;

use App\Application\Commands\Category\CreateCategoryCommand;
use App\Domain\Repositories\ICategoryRepository;

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
