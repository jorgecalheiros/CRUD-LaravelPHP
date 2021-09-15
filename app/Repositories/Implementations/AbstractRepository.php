<?php

namespace App\Repositories\Implementations;

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
        return $this->model->forceFill($data)->save();
    }

    public function list(): Collection
    {
        return $this->model->all();
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

        $model->forceFill($data);

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

    public function resolveModel()
    {
        return app($this->model);
    }
}
