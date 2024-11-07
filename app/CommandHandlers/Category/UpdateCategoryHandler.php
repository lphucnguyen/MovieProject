<?php

namespace App\CommandHandlers\Category;

use App\Commands\Category\UpdateCategoryCommand;
use App\Repositories\Contracts\ICategoryRepository;

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
