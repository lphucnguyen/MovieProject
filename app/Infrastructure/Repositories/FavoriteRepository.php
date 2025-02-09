<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Favorite;

use App\Domain\Repositories\IFavoriteRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class FavoriteRepository extends BaseRepository implements IFavoriteRepository
{
    public function __construct(
        private Favorite $model
    ) {
        parent::__construct($model);
    }
}
