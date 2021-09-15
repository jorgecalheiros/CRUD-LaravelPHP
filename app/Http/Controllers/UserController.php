<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdate;
use App\Repositories\Contracts\UserRepositoryContract;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private  UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->list();
        return view("pages.users.index", compact("users"));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->findOrFail($id);
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

        $user = $this->repository->findOrFail($id);

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
    public function update(UserUpdate $request, $id)
    {
        try {
            $data = $request->except(["_token", "_method"]);

            $user = $this->repository->findOrFail($id);

            if (!Hash::check($request->input("password"), $user->password)) {
                return back()->withErrors([
                    "message" => "Senha incorreta, tente denovo"
                ]);
            }

            if (!$this->repository->update($id, $data)) {
                throw new Exception();
            }
            return redirect(route("users.show", $id))->with([
                "sucess-message" => "Usuário editado com sucesso com sucesso"
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                "modal-message" => "Ocorreu um erro ao editar, tente mais tarde"
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
        try {
            if (!$this->repository->delete($id)) {
                throw new Exception();
            }
            return redirect(route("auth.login"))->with([
                "sucess-message" => "Usuário deletado com sucesso"
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                "modal-message" => "Error ao deletar usuário, tente denovo"
            ]);
        }
    }
}
