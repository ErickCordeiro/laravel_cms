<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        //Correção Bootstrap
        Paginator::useBootstrap();

        //Menu
        $frontMenu = [
            '/' => 'Home'
        ];

        $pages = Page::all();
        foreach ($pages as $page) {
            $frontMenu[$page["slug"]] = $page["title"];
        }

        View::share('front_menu', $frontMenu);

        //Configurações
        $config = Setting::first();
        View::share('front_config', $config);
    }
}
