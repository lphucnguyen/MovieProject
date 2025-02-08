<?php

namespace App\Application\Listeners\Category;

use App\Domain\Events\Category\CategoryUpdated;
use App\Domain\Repositories\ICategoryRepositoryNeo;

class UpdateCategory
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
    public function handle(CategoryUpdated $event): void
    {
        $this->categoryRepository->update($event->categoryId, [
            'categoryName' => $event->categoryName
        ]);
    }
}
