<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
//        // Share categories with all Blade views
//        View::composer('*', function ($view) {
//            $view->with('categories', Category::all());
//        });
    }
}
