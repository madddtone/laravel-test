<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set a default value if $metaTitle is not set
        $metaTitle = $this->app['config']->get('app.meta_title', 'Laravel');

        // Share $metaTitle to all views
        View::share('metaTitle', $metaTitle);
    }
}
