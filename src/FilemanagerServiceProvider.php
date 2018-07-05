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
        $this->publishes([
            __DIR__.'/../tmp' => public_path('tmp'),
            __DIR__.'/../uploads' => public_path('uploads'),
        ], 'generate_dump');
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
