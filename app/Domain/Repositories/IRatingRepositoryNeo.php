<?php

namespace App\Domain\Repositories;

interface IRatingRepositoryNeo
{
    public function create($filmId, $userId, $rating);
    public function update($filmId, $userId, $rating);
    public function delete($userId, $filmId);
}
