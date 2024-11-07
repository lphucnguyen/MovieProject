<?php

namespace App\DTOs\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait StaticCreateable
{
    public static function create(array $values)
    {
        $dto = new static();

        foreach ($values as $key => $value) {
            // $camelKey = str()->camel($key);

            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }

    public static function fromRequest(Request $request)
    {
        return self::create($request->all());
    }

    public static function fromModel(Model $model)
    {
        return self::create($model->toArray());
    }
}
