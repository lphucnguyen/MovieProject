<?php

namespace App\Repositories\Eloquents;

use App\Message;
use App\Repositories\BaseRepository;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
}
