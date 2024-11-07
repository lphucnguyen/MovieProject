<?php

namespace App\Commands\Category;

class GetCategoryCommand
{
    public function __construct(
        public string|null $searchKey = null
    ) {
    }
}
