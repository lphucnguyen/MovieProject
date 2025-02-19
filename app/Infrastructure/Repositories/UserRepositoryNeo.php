<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\UserNeoModel;
use App\Domain\Repositories\IUserRepositoryNeo;
use App\Shared\Infrastructure\Repositories\BaseRepositoryNeo;

class UserRepositoryNeo extends BaseRepositoryNeo implements IUserRepositoryNeo
{
    public function __construct(
        UserNeoModel $model
    ) {
        parent::__construct($model);
    }
}