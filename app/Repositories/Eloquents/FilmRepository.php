<?php

namespace App\Repositories\Eloquents;

use App\Film;
use App\Repositories\BaseRepository;

class FilmRepository extends BaseRepository
{
    public function __construct(Film $model)
    {
        parent::__construct($model);
    }
}
