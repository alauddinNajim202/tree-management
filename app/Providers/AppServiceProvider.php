<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('frontend.partials._header', function ($view) {
            $categories = \App\Models\Category::parents()->where('status', 1)->orderBy('name')->get();
            $view->with('headerCategories', $categories);
            
        });

    }
}
