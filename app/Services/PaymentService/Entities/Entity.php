<?php

namespace App\Services\PaymentService\Entities;

use Exception;

abstract class Entity {
    private $storages;

    public function __construct() {
        $this->storages = [];
    }

    public function __set($name, $value) {
        $this->storages[$name] = $value;
    }

    public function __get($name) {
        if(!isset($this->storages[$name])){
            throw new Exception("Property is not exist");
        }

        return $this->storages[$name];
    }
}