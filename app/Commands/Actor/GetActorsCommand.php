<?php

namespace App\Commands\Actor;

class GetActorsCommand
{
    public function __construct(
        public string|null $searchKey,
        public array|string|null $film,
    ) {
    }
}