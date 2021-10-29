<?php

namespace App\Repositories\Implementations;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $model = Post::class;

    //Overrides
    public function paginateWithSearch(int $perPage, string $field, string $titleSearch, string $cat = ''): LengthAwarePaginator
    {
        $mainQuery = $this->model
            ->with(["user", "categories"])
            ->when($titleSearch, function ($query) use ($titleSearch, $field) {
                $query->where($field, "like", "%$titleSearch%");
            })
            ->when($cat, function ($query) use ($cat) {
                $query->whereHas("categories", function ($query) use ($cat) {
                    $query->where("categories.slug", $cat);
                });
            });
        return $mainQuery->paginate($perPage);
    }
}
