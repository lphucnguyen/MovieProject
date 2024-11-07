<?php

namespace App\Commands\Category;

use App\DTOs\Category\UpdateCategoryDTO;

class UpdateCategoryCommand
{
    public function __construct(
        public string $uuid,
        public UpdateCategoryDTO $data
    ) {
    }
}
