<?php

namespace App;

trait ExtendedModel {
    public function getAllAttributes(): Array
    {
        $columns = $this->getFillable();

        $attributes = $this->getAttributes();

        foreach ($columns as $column)
        {
            if (!array_key_exists($column, $attributes))
            {
                $attributes[$column] = null;
            }
        }
        return $attributes;
    }
}