<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Favorite;

use App\Domain\Repositories\IFavoriteRepository;

class FavoriteRepository extends BaseRepository implements IFavoriteRepository
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }
}
