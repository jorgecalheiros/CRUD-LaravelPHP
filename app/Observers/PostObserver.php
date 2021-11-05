<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\Contracts\UploadFileServiceContract;
use Cache;

class PostObserver
{
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
