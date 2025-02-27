<?php

namespace App\Application\Commands\User;

class GetUsersCommand
{
    public function __construct(
        public string|null $searchKey,
    ) {
    }
}
