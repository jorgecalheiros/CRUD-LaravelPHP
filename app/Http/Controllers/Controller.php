<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Log;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function redirectWithErrors(Throwable $th, string $userMessage)
    {
        $controller = request()->route()->action["controller"];

        Log::error($controller . "---" . $th->getMessage() . PHP_EOL . $th->getTraceAsString());

        $errors = [
            "modal-message" => $userMessage
        ];

        if (env("APP_ENV") != "production") {
            $errors["modal-dev-message"] = $th->getMessage();
        }

        return redirect()->back()->withErrors($errors);
    }
}
