<?php

namespace App\Application\Commands\Category;

use App\Application\DTOs\Category\UpdateCategoryDTO;

class UpdateCategoryCommand
{
    public function __construct(
        public string $uuid,
        public UpdateCategoryDTO $data
    ) {
    }
}
