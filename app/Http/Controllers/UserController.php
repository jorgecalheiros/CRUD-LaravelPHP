<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdate;
use App\Repositories\Contracts\UserRepositoryContract;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        $users = $this->repository->paginate(5);
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
            "title" => __("user.text.title.edit"),
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
                    "modal-message" => __("auth.password")
                ]);
            }

            if (!$update = $this->repository->update($id, $data)) {
                throw new Exception($update);
            }
            return redirect(route("users.show", $id))->with([
                "success-message" => __("user.success.update")
            ]);
        } catch (\Throwable $th) {
            Log::error("UserController@update " . $th->getMessage());

            $errors = [
                "modal-message" => __("user.error.update")
            ];

            if (env("APP_ENV") != "production") {
                $errors['modal-dev-message'] = $th->getMessage();
            }

            return redirect()->back()->withErrors($errors);
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
            if (!$destroy = $this->repository->delete($id)) {
                throw new Exception($destroy);
            }
            return redirect(route("auth.login"))->with([
                "success-message" => __("user.success.destroy")
            ]);
        } catch (\Throwable $th) {
            Log::error("UserController@destroy" . $th->getMessage());

            $errors = [
                "modal-message" => __("user.error.destroy")
            ];

            if (env("APP_ENV") != "production") {
                $errors["modal-dev-message"] = $th->getMessage();
            }

            return redirect()->back()->withErrors($errors);
        }
    }
}
