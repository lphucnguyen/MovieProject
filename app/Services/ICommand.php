<?php

namespace App\Services;

use App\DTOs\BaseDTO;

interface ICommand
{
    public function create(BaseDTO $dto);
    public function update($uuid, BaseDTO $dto);
    public function delete($uuid);
}
