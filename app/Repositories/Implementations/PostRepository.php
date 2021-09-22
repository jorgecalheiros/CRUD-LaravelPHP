<?php

namespace App\Repositories\Implementations;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $model = Post::class;
}
