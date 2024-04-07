<?php

namespace App\Repositories\Eloquents;

use App\Favorite;
use App\Repositories\BaseRepository;

class FavoriteRepository extends BaseRepository
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }
}
