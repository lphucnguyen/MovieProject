<?php

namespace App\CommandHandlers\Category;

use App\Commands\Category\DeleteCategoryCommand;
use App\Repositories\Contracts\ICategoryRepository;
use Illuminate\Validation\ValidationException;

class DeleteCategoryHandler
{
    public function __construct(
        private ICategoryRepository $repository
    ) {
    }

    public function handle(DeleteCategoryCommand $command)
    {
        $category = $this->repository->get($command->uuid);
        $category->delete();
    }
}
