<?php

namespace App\Traits;

trait ExtendedModel
{
    public function getAllAttributes()
    {
        $columns = $this->getFillable();

        $attributes = $this->getAttributes();

        foreach ($columns as $column) {
            if (!array_key_exists($column, $attributes)) {
                $attributes[$column] = null;
            }
        }
        return $attributes;
    }
}
