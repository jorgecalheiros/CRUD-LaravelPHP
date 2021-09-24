<?php

namespace App\Repositories\Implementations;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $model = Post::class;

    //Overrides
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->model->with("user")->paginate($perPage);
    }
}
