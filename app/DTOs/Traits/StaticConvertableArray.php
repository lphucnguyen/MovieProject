<?php

namespace App\DTOs\Traits;

trait StaticConvertableArray
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
