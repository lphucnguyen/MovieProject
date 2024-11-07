<?php

namespace App\Commands\Admin;

class GetAdminsCommand
{
    public function __construct(
        public string|null $searchKey,
        public int|null $perPage,
    ) {
    }
}
