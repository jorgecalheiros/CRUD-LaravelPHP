<?php

namespace App\Observers;

use App\Models\Post;
use App\Repositories\Contracts\CategoryPostRepositoryContract;
use App\Services\Contracts\UploadFileServiceContract;
use Cache;

class PostObserver
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(CategoryPostRepositoryContract::class);
    }
    /**
     * Heandle the User "saving" event
     */
    public function saving(Post $post)
    {
        if (request()->hasFile("post_picture")) {
            $this->UpdatePostPicture($post);
        }
    }

    /**
     * Heandle the User "saving" event
     */
    public function saved()
    {
        Cache::tags(["posts", "post.show"])->flush();
    }

    /**
     * Heandle the User "created" event
     */
    public function created(Post $post)
    {
        $data = [
            "post_id" => $post->id,
            "category_id" => request("category")
        ];

        $this->repository->create($data);
    }


    /**
     * Heandle the User "updated" event
     */
    /*public function updated(Post $post)
    {
        $data = [
            "post_id" => $post->id,
            "category_id" => request("category")
        ];

        $this->repository->update($post->id, $data);
    }*/

    /**
     *
     */
    private function UpdatePostPicture(Post $post)
    {
        $postPicture = request()->file("post_picture");
        $postDirectory = "public/posts/$post->id/cover";

        /**
         * @var UploadFileServiceContract
         */
        $fileServices = app(UploadFileServiceContract::class);

        if (!$filePath = $fileServices->run($postPicture, $postDirectory)) {
            return false;
        }
        $post->photo = $filePath;
    }
}
