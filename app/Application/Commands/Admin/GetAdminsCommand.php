<?php

namespace App\Application\Commands\Admin;

class GetAdminsCommand
{
    public function __construct(
        public string|null $searchKey,
        public int|null $perPage,
    ) {
    }
}
