<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    protected $model = User::class;

    public function export()
    {
        return $this->model->all();
    }

    public function import(array $users)
    {
        return $this->model->insert($users);
    }

    public function findValue(string $column, string $value)
    {
        return $this->model->where($column, $value)->first();
    }
}
