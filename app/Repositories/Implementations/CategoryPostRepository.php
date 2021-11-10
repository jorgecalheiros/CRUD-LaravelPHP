<?php

namespace App\Repositories\Implementations;

use App\Models\CategoryPost;
use App\Repositories\Contracts\CategoryPostRepositoryContract;
use App\Repositories\Implementations\AbstractRepository;

class CategoryPostRepository extends AbstractRepository implements CategoryPostRepositoryContract
{
    protected $model = CategoryPost::class;
}
