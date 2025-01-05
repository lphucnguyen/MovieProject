<?php

namespace App\Application\Commands\Category;

class DeleteCategoryCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
