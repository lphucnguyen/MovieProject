<?php

namespace App\Application\CommandHandlers\Category;

use App\Application\Commands\Category\DeleteCategoryCommand;
use App\Domain\Repositories\ICategoryRepository;
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
