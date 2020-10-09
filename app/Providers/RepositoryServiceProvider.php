<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\PostRepository::class, \App\Repositories\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FilmRepository::class, \App\Repositories\FilmRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LivrosRepository::class, \App\Repositories\LivrosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClientesRepository::class, \App\Repositories\ClientesRepositoryEloquent::class);
        //:end-bindings:
    }
}
