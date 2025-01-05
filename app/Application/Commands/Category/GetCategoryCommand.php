<?php

namespace App\Application\Commands\Category;

class GetCategoryCommand
{
    public function __construct(
        public string|null $searchKey = null
    ) {
    }
}
