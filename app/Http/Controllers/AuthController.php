<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
            "message" => "Email ou senha incorretos"
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
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|email",
                "password" => "required|min:8"
            ]);

            if ($validator->failed()) {
                return redirect()->back()->withErrors($validator);
            }

            $user = new User();

            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = Hash::make($request->input("password"));

            if (!$user->save()) {
                throw new Exception();
            }
            return redirect(route("auth.login"))->with([
                "message" => "Usuário criado com sucesso"
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                "message" => "Ocorreu um erro ao cadastrar, tente mais tarde"
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
