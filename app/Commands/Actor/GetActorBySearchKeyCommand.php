<?php

namespace App\Commands\Actor;

class GetActorBySearchKeyCommand
{
    public function __construct(
        public string|null $searchKey
    ) {
    }
}
