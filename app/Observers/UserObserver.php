<?php

namespace App\Observers;

use App\Mail\NewUserMailable;
use App\Models\User;
use App\Services\Contracts\UploadFileServiceContract;
use Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $newUserMailable = new NewUserMailable($user->name, $user->email, '(12) 4002-8922');
        Mail::to($user->email)->queue($newUserMailable);
    }

    /**
     * Heandle the User "updating" event
     */
    public function updating(User $user)
    {
        if (request()->hasFile("profile_picture")) {
            $this->updateProfilePicture($user);
        }
    }

    /**
     *
     */
    private function updateProfilePicture(User $user)
    {
        $profilePicture = request()->file("profile_picture");
        $userDirectory = "public/users/$user->id/profile";

        /**
         * @var UploadFileServiceContract
         */
        $fileServices = app(UploadFileServiceContract::class);

        if (!$filePath = $fileServices->run($profilePicture, $userDirectory)) {
            return false;
        }
        $user->photo = $filePath;
    }
}
