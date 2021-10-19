<?php

namespace App\Http\Controllers;

use App\Jobs\ExportDatabaseRegister;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function importUsers()
    {
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
