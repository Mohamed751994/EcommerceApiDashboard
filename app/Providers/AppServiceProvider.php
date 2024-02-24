<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();
        //Menu SideBar
        View::share('menuData', Menu::with('children')->whereType('parent')->orderBy('sort', 'asc')->orderBy('name', 'asc')->whereStatus(0)->get());
        View::share('languages', Language::active()->sort()->get());

    }
}
