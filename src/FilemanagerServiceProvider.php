<?php

namespace Rvmehta745\Filemanager;

use Illuminate\Support\ServiceProvider;

class FilemanagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Filemanager::class, function () {
            return new Filemanager();
        });
        $this->app->alias(Filemanager::class, 'filemanager');
    }
}
