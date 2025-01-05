<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Admin;

use App\Domain\Repositories\IAdminRepository;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    public function __construct(
        private Admin $model
    ) {
        parent::__construct($model);
    }

    public function count()
    {
        return $this->model->whereRoleIs('admin')->count();
    }
}
