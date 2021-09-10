<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("pages.users.index", compact("users"));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $url = env("APP_URL");
        return view("pages.users.show", compact("user", "url"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $config = [
            "onlyEdit" => true,
            "title" => "Editar usuário",
            "method" => "POST",
            "_method" => "PUT",
            "route" => route("users.update", $id)
        ];

        return view("pages.users.form", compact("user", "config"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

            $user = User::find($id);

            if (!Hash::check($request->input("password"), $user->password)) {
                return back()->withErrors([
                    "message" => "Senha incorreta, tente denovo"
                ]);
            }

            $user->name = $request->input("name");
            $user->email = $request->input("email");

            if (!$user->save()) {
                throw new Exception();
            }
            return redirect(route("users.show", $id))->with([
                "message" => "Usuário editado com sucesso com sucesso"
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                "message" => "Ocorreu um erro ao editar, tente mais tarde"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        try {
            if (!$user->delete()) {
                throw new Exception();
            }
            return redirect(route("users.login"))->with([
                "message" => "Usuário deletado com sucesso"
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                "message" => "Error ao deletar usuário, tente denovo"
            ]);
        }
    }
}
