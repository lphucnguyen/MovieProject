<?php

namespace App\Domain\Events\Category;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $categoryId
    ) {
    }
}
