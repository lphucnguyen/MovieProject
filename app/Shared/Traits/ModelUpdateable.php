<?php

namespace App\Shared\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelUpdateable
{
    public function isUpdate(Model $model) {
        $fieldsUpdated = $model->getChanges();

        foreach ($fieldsUpdated as $key => $value) {
            $fileds[] = $key;
        }

        $array_same = array_intersect($fileds, $model->getFillable());

        if (count($array_same) === 0) {
            return false;
        }

        return true;
    }
}
