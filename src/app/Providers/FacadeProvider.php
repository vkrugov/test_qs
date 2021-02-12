<?php

namespace App\Providers;

use App\Services\HabrParse\HabrParserService;
use Illuminate\Support\ServiceProvider;

class FacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('habrParser', function () {
            return new HabrParserService();
        });
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
