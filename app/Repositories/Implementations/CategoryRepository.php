<?php

namespace App\Repositories\Implementations;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Implementations\AbstractRepository;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryContract
{
    protected $model = Category::class;

    public function list(bool $useCache = true, int $limit = 5): Collection
    {
        if (Cache::get('categories') && $useCache) {
            $categories = Cache::get("categories");
            return $categories;
        }

        $categories = $this->model->limit($limit)->get();

        if (count($categories) > 0) {
            Cache::add("categories", $categories);
            return $categories;
        }

        return $categories;
    }
}
