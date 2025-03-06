<?php

namespace App\Shared\Domain\Models;

interface INeoModel
{
    public function getClient();
    public function create(array $properties);
    public function update(string $keyValue, array $properties);
    public function delete(string $keyValue);
}