<?php

namespace App\Repositories\Eloquents;

use App\Admin;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IAdminRepository;

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
