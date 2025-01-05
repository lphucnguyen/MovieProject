<?php

namespace App\Application\DTOs;

use App\Application\DTOs\Traits\StaticConvertableArray;
use App\Application\DTOs\Traits\StaticCreateable;

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
