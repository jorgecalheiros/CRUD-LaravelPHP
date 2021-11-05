<?php

namespace App\Http\Controllers;

use App\Http\Requests\System\ImportUserRequest;
use App\Jobs\ExportDatabaseRegister;
use App\Jobs\ImportUsers;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UploadFileServiceContract;
use Exception;

class SettingController extends Controller
{
    public function importUsers(ImportUserRequest $request, UploadFileServiceContract $fileService)
    {
        try {
            $userRepository = app(UserRepositoryContract::class);

            $file = $request->except("_token");

            if (!$filePath = $fileService->run($file["users-file"], "imports/users")) {
                throw new Exception($filePath);
            }



            $job = new ImportUsers($userRepository, $filePath);

            $job->onQueue("imports");

            if (!$this->dispatch($job)) {
                throw new Exception($job);
            }


            return back()->with([
                'success-message' => __("setting.success.import-export")
            ]);
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("user.error.file"));
        }
    }

    public function exportUsers()
    {
        $userRepository = app(UserRepositoryContract::class);

        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;

        $job = new ExportDatabaseRegister($userRepository, "exports/users", $userName, $userEmail);

        $job->onQueue("exports");

        $this->dispatch($job);

        return back()->with([
            'success-message' => 'Report requested with success!'
        ]);
    }
}
