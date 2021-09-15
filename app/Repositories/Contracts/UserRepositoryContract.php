<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface UserRepositoryContract
{
    public function create(array $data);

    public function list(): Collection;

    public function update($id, array $data);

    public function findOrFail($id);

    public function delete($id);

    public function resolveModel();
}
