<?php

namespace App\Domain\Repositories;

use App\Shared\Domain\Repositories\IRepository;

interface IUserRepository extends IRepository
{
    public function getFavorites($uuid);

    public function getRatings($uuid);

    public function getReviews($uuid);

    public function getOrders($uuid);
}
