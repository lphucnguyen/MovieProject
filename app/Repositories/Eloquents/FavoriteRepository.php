<?php

namespace App\Repositories\Eloquents;

use App\Favorite;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IFavoriteRepository;

class FavoriteRepository extends BaseRepository implements IFavoriteRepository
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }
}
