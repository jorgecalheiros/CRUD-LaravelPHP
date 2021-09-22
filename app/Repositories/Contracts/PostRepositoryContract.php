<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PostRepositoryContract
{
    public function create(array $data);

    public function list(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;

    public function update($id, array $data);

    public function findOrFail($id);

    public function delete($id);

    public function resolveModel();
}
