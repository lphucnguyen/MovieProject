<?php

namespace App\DTOs;

use App\DTOs\Traits\StaticConvertableArray;
use App\DTOs\Traits\StaticCreateable;

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
