<?php

namespace App\Repositories\Implementations;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function create(array $data)
    {
        return $this->model->fill($data)->save();
    }

    public function list(): Collection
    {
        return $this->model->all();
    }

    public function paginateWithSearch(int $perPage, string $field, string $nameSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model
            ->when($nameSearch, function ($query) use ($nameSearch, $field) {
                $query->where($field, "like", "%$nameSearch%");
            });

        return $mainQuery->paginate($perPage);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data)
    {
        /**
         *  @var Model $model
         */

        $model = $this->model->findOrFail($id);

        $model->fill($data);

        return $model->save();
    }

    public function delete($id)
    {
        /**
         *  @var Model $model
         */

        $model = $this->model->findOrFail($id);

        return $model->delete();
    }

    public function getTable(): string
    {
        return $this->model->getTable();
    }

    public function resolveModel()
    {
        return app($this->model);
    }
}
