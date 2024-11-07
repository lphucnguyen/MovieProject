<?php

namespace App\Commands\Category;

use App\DTOs\Category\CreateCategoryDTO;

class CreateCategoryCommand
{
    public function __construct(
        public CreateCategoryDTO $data
    ) {
    }
}
