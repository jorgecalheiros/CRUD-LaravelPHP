<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStore;
use App\Http\Requests\Post\PostUpdate;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Contracts\PostRepositoryContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function index(Request $request)
    {

        $titleSearch = $request->get("s", "") ?? "";
        $page = $request->get("page", 1) ?? 1;
        $cat = $request->get("cat", "") ?? "";

        $categoryRepository = app(CategoryRepositoryContract::class);
        $categories = $categoryRepository->list(true);

        $posts = $this->repository->postPaginateWithSearch(5, $page, "title", $titleSearch, $cat);


        return view("pages.posts.index", compact("posts", "categories"));
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
            $data["user_id"] = auth()->user()->id;

            if (!$created = $this->repository->create($data)) {
                throw new Exception($created);
            }

            return redirect(route("posts.index"))->with([
                "success-message" => __("post.success.store")
            ]);
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("post.error.store"));
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
        if (!$post = Cache::tags("post.show")->get("post.show:$id")) {
            $post = $this->repository->findOrFail($id);
            Cache::tags("post.show")->put("post.show:$id", $post);
        }
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
        $post = $this->repository->findOrFail($id);

        $config = [
            "onlyEdit" => true,
            "title" => __("post.text.title.edit"),
            "method" => "POST",
            "_method" => "PUT",
            "route" => route("posts.update", $id)
        ];

        return view("pages.posts.form", compact("post", "config"));
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
            $data["user_id"] = auth()->user()->id;

            if (!$updated = $this->repository->update($id, $data)) {
                throw new Exception($updated);
            }

            //Cache::tags(["posts"])->flush();

            return redirect(route("posts.show", $id))->with([
                "success-message" => __("post.success.update")
            ]);
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("post.error.update"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!$destroy = $this->repository->delete($id)) {
                throw new Exception($destroy);
            }

            //Cache::tags(["posts"])->flush();

            return redirect(route("posts.index"))->with([
                "success-message" => __("post.success.destroy")
            ]);
        } catch (\Throwable $th) {
            return $this->redirectWithErrors($th, __("post.error.destroy"));
        }
    }
}
