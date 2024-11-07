<?php

namespace App\Repositories\Eloquents;

use App\Message;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IMessageRepository;

class MessageRepository extends BaseRepository implements IMessageRepository
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function getMessagesByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return $query->where(function ($query) use ($queryParams) {
                $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                    return $q->where('email', 'like', '%' . $queryParams['searchKey'] . '%')
                        ->orWhere('title', 'like', '%' . $queryParams['searchKey'] . '%');
                });
        })->latest()->paginate(config('app.perPage'));
    }
}
