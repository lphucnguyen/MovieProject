<?php

namespace App\Shared\Domain\Repositories;

interface IRepositoryNeo
{
    public function create(array $data);

    public function update(string $uuid, array $data);

    public function delete(string $uuid);

    public function getClient();
}
