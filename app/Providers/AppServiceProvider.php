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
        // Share categories with layout navbar dropdown
        View::composer('layouts.app', function ($view) {
            $view->with('navCategories', Category::orderBy('name')->get());
        });
    }
}
