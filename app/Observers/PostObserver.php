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
            $this->updateProfilePicture($post);
        }
    }

    /**
     *
     */
    private function updateProfilePicture(Post $post)
    {
        $profilePicture = request()->file("profile_picture");
        $userDirectory = "public/posts/$post->id/cover";

        /**
         * @var UploadFileServiceContract
         */
        $fileServices = app(UploadFileServiceContract::class);

        if (!$filePath = $fileServices->run($profilePicture, $userDirectory)) {
            return false;
        }
        $post->photo = $filePath;
    }
}
