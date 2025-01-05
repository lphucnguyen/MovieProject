<?php

namespace App\Application\Commands\Category;

use App\Application\DTOs\Category\CreateCategoryDTO;

class CreateCategoryCommand
{
    public function __construct(
        public CreateCategoryDTO $data
    ) {
    }
}
