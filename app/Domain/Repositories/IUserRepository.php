<?php

namespace App\Domain\Repositories;

interface IUserRepository extends IRepository
{
    public function getTransactions($uuid);

    public function getFavorites($uuid);

    public function getRatings($uuid);

    public function getReviews($uuid);
}
