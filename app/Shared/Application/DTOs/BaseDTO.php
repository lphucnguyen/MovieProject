<?php

namespace App\Shared\Application\DTOs;

use App\Shared\Application\Concerns\StaticConvertableArray;
use App\Shared\Application\Concerns\StaticCreateable;

class BaseDTO
{
    use StaticCreateable;
    use StaticConvertableArray;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
