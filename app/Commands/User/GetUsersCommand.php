<?php

namespace App\Commands\User;

class GetUsersCommand
{
    public function __construct(
        public string|null $searchKey,
        public int|null $perPage,
    ) {
    }
}
