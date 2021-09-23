<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStore;
use App\Http\Requests\Post\PostUpdate;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Exception;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    private PostRepositoryContract $repository;

    public function __construct(PostRepositoryContract $repository)
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
        $posts = $this->repository->paginate(5);
        return view("pages.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            "onlyEdit" => false,
            "title" => __("post.text.title.create"),
            "method" => "POST",
            "route" => route("posts.store")
        ];

        return view("pages.posts.form", compact("config"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStore $request)
    {
        try {
            $data = $request->except(["_token"]);

            if (!$created = $this->repository->create($data)) {
                throw new Exception($created);
            }
            return redirect(route("post.index"))->with([
                "success-message" => __("post.success.store")
            ]);
        } catch (\Throwable $th) {
            Log::error("PostController@store " . $th->getMessage());
            $errors = [
                "modal-message" => __("post.error.store")
            ];
            if (env("APP_ENV") != "production") {
                $errors['modal-dev-message'] = $th->getMessage();
            }

            return redirect()->back()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->findOrFail($id);
        $url = env("APP_URL");
        return view("pages.posts.show", compact("post", "url"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->findOrFail($id);

        $config = [
            "onlyEdit" => true,
            "title" => __("post.text.title.edit"),
            "method" => "POST",
            "_method" => "PUT",
            "route" => route("posts.update", $id)
        ];

        return view("pages.posts.form", compact("user", "config"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdate $request, $id)
    {
        try {
            $data = $request->except(["_token", "_method"]);

            if (!$updated = $this->repository->update($id, $data)) {
                throw new Exception($updated);
            }

            return redirect(route("post.show", $id))->with([
                "success-message" => __("post.success.update")
            ]);
        } catch (\Throwable $th) {
            Log::error("PostController@update" . $th->getMessage());

            $errors = [
                "modal-message" => _("post.error.update")
            ];

            if (env("APP_ENV") != "production") {
                $errors["modal-dev-message"] = $th->getMessage();
            }

            return redirect()->back()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
