<?php

namespace App\Providers;

use App\Repositories\Contracts\PostRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Implementations\PostRepository;
use App\Repositories\Implementations\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Repositorys

        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(PostRepositoryContract::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
