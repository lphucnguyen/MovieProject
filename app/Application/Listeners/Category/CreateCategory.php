<?php

namespace App\Application\Listeners\Category;

use App\Domain\Events\Category\CategoryCreated;
use App\Domain\Repositories\ICategoryRepositoryNeo;

class CreateCategory
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private ICategoryRepositoryNeo $categoryRepository,
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CategoryCreated $event): void
    {
        $this->categoryRepository->create([
            'id' => $event->categoryId,
            'categoryName' => $event->categoryName
        ]);
    }
}
