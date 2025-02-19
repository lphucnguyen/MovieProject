<?php

namespace App\Shared\Application\DTOs\Concerns;

trait StaticConvertableArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
