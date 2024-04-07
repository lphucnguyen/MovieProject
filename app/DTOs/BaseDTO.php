<?php

namespace App\DTOs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseDTO
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function fromModel(Model $model)
    {
        $dto = new static();

        foreach ($model->getAttributes() as $key => $value) {
            $dto->{$key} = $value;
        }
        return $dto;
    }

    public static function fromArray(array $data)
    {
        $dto = new static();

        foreach ($data as $key => $value) {
            $dto->{$key} = $value;
        }
        return $dto;
    }

    public static function fromRequest(Request $request)
    {
        $dto = new static();

        foreach ($request->all() as $key => $value) {
            $dto->{$key} = $value;
        }
        return $dto;
    }

    public static function toArray(BaseDTO $dto)
    {
        return get_object_vars($dto);
    }
}
