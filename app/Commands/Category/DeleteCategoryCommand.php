<?php

namespace App\Commands\Category;

class DeleteCategoryCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
