<?php

namespace App\Repositories\Eloquents;

use App\Admin;
use App\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}
