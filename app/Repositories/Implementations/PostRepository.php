<?php

namespace App\Repositories\Implementations;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $model = Post::class;

    //Overrides
    public function postPaginateWithSearch(int $perPage, int $page, string $field, string $titleSearch, string $cat = ''): LengthAwarePaginator
    {
        $avoidCache = $titleSearch || $cat;

        $posts = Cache::tags(["posts"])->get("posts:$page");

        if (!$avoidCache && $posts && count($posts) > 0) {
            return $posts;
        }

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
        $posts = $mainQuery->paginate($perPage);

        if (!$avoidCache) {
            Cache::tags(["posts"])->put("posts:$page", $posts);
        }

        return $posts;
    }
}
