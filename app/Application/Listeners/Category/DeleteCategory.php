<?php

namespace App\Application\Listeners\Category;

use App\Domain\Events\Category\CategoryDeleted;
use App\Domain\Repositories\ICategoryRepositoryNeo;

class DeleteCategory
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
    public function handle(CategoryDeleted $event): void
    {
        $this->categoryRepository->delete($event->categoryId);
    }
}
