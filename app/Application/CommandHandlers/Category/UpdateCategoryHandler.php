<?php

namespace App\Application\CommandHandlers\Category;

use App\Application\Commands\Category\UpdateCategoryCommand;
use App\Domain\Repositories\ICategoryRepository;

class UpdateCategoryHandler
{
    public function __construct(
        private ICategoryRepository $repository
    ) {
    }

    public function handle(UpdateCategoryCommand $command)
    {
        $this->repository->update(
            $command->uuid,
            $command->data->toArray()
        );
    }
}
