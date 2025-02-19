<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Admin;

use App\Domain\Repositories\IAdminRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    public function __construct(
        Admin $model
    ) {
        parent::__construct($model);
    }

    public function count()
    {
        return $this->model->whereRoleIs('admin')->count();
    }
}
