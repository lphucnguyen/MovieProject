<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Message;

use App\Domain\Repositories\IMessageRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

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
