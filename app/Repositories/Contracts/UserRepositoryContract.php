<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryContract
{
    public function create(array $data);

    public function list(): Collection;

    public function paginateWithSearch(int $perPage, string $field, string $nameSearch): LengthAwarePaginator;

    public function update($id, array $data);

    public function findOrFail($id);

    public function delete($id);

    public function resolveModel();

    public function getTable(): string;

    public function export();

    public function import(array $users);

    public function findValue(string $column, string $value);
}
