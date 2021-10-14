<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\UserStore;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryContract;

class AuthController extends Controller
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for login a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $url = env("APP_URL");

        if (Auth::check()) {
            return redirect(route("users.index"));
        }

        return view("pages.users.login", compact("url"));
    }

    /**
     * authenticate token
     */
    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();

        return redirect("/");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect(route("users.index"));
        }

        $config = [
            "onlyEdit" => false,
            "title" => __("user.text.SignUp"),
            "method" => "POST",
            "route" => route("auth.store")
        ];

        return view("pages.users.form", compact("config"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        try {
            if (!$created = $this->repository->create($request->getUserData())) {
                throw new Exception($created);
            }

            return redirect(route("auth.login"))->with([
                "success-message" => __("user.success.store")
            ]);
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("user.error.store"));
        }
    }

    /**
     * logout user
     */
    public function logout()
    {
        try {
            if ($logout = Auth::logout()) {
                return redirect(route("auth.login"));
            } else {
                throw new Exception($logout);
            }
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("user.error.logout"));
        }
    }
}
