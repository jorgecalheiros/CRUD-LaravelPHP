<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Http\Request;

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
            "title" => __("user.text.title.create"),
            "method" => "POST",
            "route" => route("auth.store")
        ];

        return view("pages.posts.form", compact("config"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            "title" => __("user.text.title.edit"),
            "method" => "POST",
            "_method" => "PUT",
            "route" => route("users.update", $id)
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
    public function update(Request $request, Post $post)
    {
        //
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
