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
        return User::insert($users);
    }

    public function find_value(string $column, string $value)
    {
        return User::where($column, $value)->first();
    }
}
