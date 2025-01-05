<?php

namespace App\Infrastructure\Repositories;


use App\Domain\Repositories\IReviewRepository;
use App\Domain\Models\Review;

class ReviewRepository extends BaseRepository implements IReviewRepository
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function getReviewByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return $query->with('user')->with('film')
            ->where(function ($query) use ($queryParams) {
                $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                    $searchKey = $queryParams['searchKey'];

                    return $q->whereHas('user', function ($q2) use ($searchKey) {
                        $q2->where('username', 'LIKE', "%{$searchKey}%");
                    });
                });
            })
            ->orWhere(function ($query) use ($queryParams) {
                $query->when($queryParams, function ($q) use ($queryParams) {
                    $searchKey = $queryParams['searchKey'];

                    return $q->whereHas('film', function ($q2) use ($searchKey) {
                        $q2->where('name', 'LIKE', "%{$searchKey}%");
                    });
                });
            })
            ->latest()->paginate(config('app.perPage'));
    }
}
