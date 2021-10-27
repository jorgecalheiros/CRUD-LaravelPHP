<?php

namespace App\Repositories\Implementations;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $model = Post::class;

    //Overrides
    public function paginateWithSearch(int $perPage, string $field, string $titleSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model
            ->with(["user", "categories"])
            ->when($titleSearch, function ($query) use ($titleSearch, $field) {
                $query->where($field, "like", "%$titleSearch%");
            });
        return $mainQuery->paginate($perPage);
    }
}
