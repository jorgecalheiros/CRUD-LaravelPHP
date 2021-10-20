<?php

namespace App\Http\Controllers;

use App\Jobs\ExportDatabaseRegister;
use App\Jobs\ImportUsers;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UploadFileServiceContract;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function importUsers(Request $request, UploadFileServiceContract $fileService)
    {
        try {
            if (!$filePath = $request->file("users-file")) {
                throw new Exception($filePath);
            }

            if (!$fileService->run($filePath, "imports/users")) {
                throw new Exception($filePath);
            }

            $job = new ImportUsers($filePath);

            $job->onQueue("imports");

            $this->dispatch($job);


            return back()->with([
                'success-message' => 'Report requested with success!'
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
