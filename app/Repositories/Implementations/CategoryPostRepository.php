<?php

namespace App\Repositories\Implementations;

use App\Models\CategoryPost;
use App\Repositories\Contracts\CategoryPostRepositoryContract;
use App\Repositories\Implementations\AbstractRepository;

class CategoryPostRepository extends AbstractRepository implements CategoryPostRepositoryContract
{
    protected $model = CategoryPost::class;

    /*public function create(array $data)
    {
        $cat = $data["cat"];

        $query = $this->model->all();

        $query = $this->model->with("post", "categories")->when($cat, function ($query) use ($cat) {
            $query->whereHas("categories", function ($query) use ($cat) {
                $query->where("categories.slug", $cat);
            });
        });

        return $query;
    }*/
}
