<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\Contracts\UploadFileServiceContract;

class PostObserver
{
    /**
     * Heandle the User "saving" event
     */
    public function saving(Post $post)
    {
        if (request()->hasFile("profile_picture")) {
            $this->UpdatePostPicture($post);
        }
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
