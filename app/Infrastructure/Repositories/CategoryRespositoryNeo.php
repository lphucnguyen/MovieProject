<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\CategoryNeoModel;
use App\Domain\Repositories\ICategoryRepositoryNeo;
use App\Shared\Infrastructure\Repositories\BaseRepositoryNeo;

class CategoryRepositoryNeo extends BaseRepositoryNeo implements ICategoryRepositoryNeo
{
    public function __construct(
        CategoryNeoModel $model
    ) {
        parent::__construct($model);
    }
}