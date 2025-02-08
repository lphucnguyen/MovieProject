<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Models\INeoModel;

interface IFilmRepositoryNeo extends INeoModel
{
    public function getRecommendByUser($userId);
}
