<?php

namespace App\Shared\Application\DTOs\Traits;

trait StaticConvertableArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
