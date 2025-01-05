<?php

namespace App\Application\Commands\Actor;

class GetActorBySearchKeyCommand
{
    public function __construct(
        public string|null $searchKey
    ) {
    }
}
