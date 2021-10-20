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
}
