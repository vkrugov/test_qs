<?php

namespace App\Providers;

use App\Repositories\ParsingLog\ParsingLogRepository;
use App\Repositories\ParsingLog\ParsingLogRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostTags\PostTagsRepository;
use App\Repositories\PostTags\PostTagsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostTagsRepositoryInterface::class, PostTagsRepository::class);
        $this->app->bind(ParsingLogRepositoryInterface::class, ParsingLogRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
