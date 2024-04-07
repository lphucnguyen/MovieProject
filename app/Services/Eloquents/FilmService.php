<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\IFilmRepository;
use App\Services\BaseService;
use App\Services\IService;

class FilmService extends BaseService implements IService
{
    public function __construct(IFilmRepository $repository)
    {
        parent::__construct($repository);
    }
}
