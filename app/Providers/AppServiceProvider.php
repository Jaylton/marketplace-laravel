<?php

namespace App\Providers;

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
    \PagSeguro\Library::initialize();
    \PagSeguro\Library::cmsVersion()->setName("CursoLaravel")->setRelease("1.0.0");
    \PagSeguro\Library::moduleVersion()->setName("CursoLaravel")->setRelease("1.0.0");

    $categories = \App\Category::all();
    // view()->share('categories', $categories);
    // view()->composer(['welcome', 'single'], function ($view) use($categories)
    view()->composer('layouts.front', function ($view) use($categories)
    {
        $view->with('categories', $categories);
    });
    }
}
