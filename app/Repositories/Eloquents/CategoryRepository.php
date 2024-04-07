<?php

namespace App\Repositories\Eloquents;

use App\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
