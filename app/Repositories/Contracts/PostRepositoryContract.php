<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PostRepositoryContract
{
    public function create(array $data);

    public function list(): Collection;

    public function paginateWithSearch(int $perPage, string $field, string $titleSearch): LengthAwarePaginator;

    public function update($id, array $data);

    public function findOrFail($id);

    public function delete($id);

    public function resolveModel();
}
