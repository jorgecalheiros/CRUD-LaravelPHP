<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route("users.index"));
        }
        return back()->withErrors([
            "modal-message" => "Email ou senha incorretos"
        ]);
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
            "title" => "Criar usuário",
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
            $data = $request->except(["_token", "reppassword"]);
            $data["password"] = Hash::make($data["password"]);

            if (!$this->repository->create($data)) {
                throw new Exception();
            }

            return redirect(route("auth.login"))->with([
                "success-message" => "Usuário criado com sucesso"
            ]);
        } catch (\Throwable $th) {
            Log::error("authController@store " . $th->getMessage());
            return redirect()->back()->withErrors([
                "modal-message" => "Ocorreu um erro ao cadastrar, tente mais tarde"
            ]);
        }
    }

    /**
     * logout user
     */
    public function logout()
    {
        try {
            if (Auth::logout()) {
                return redirect(route("auth.login"));
            }
            throw new Exception();
        } catch (\Throwable $th) {
            return back()->withErrors([
                "message" => "Não foi possivel fazer logout"
            ]);
        }
    }
}
