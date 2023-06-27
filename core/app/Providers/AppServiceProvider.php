<?php

namespace App\Providers;


use App\Models\Setting;
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
        // if (!file_exists('core/storage/installed') && !request()->is('install') && !request()->is('install/*')) {
        //     header("Location: install/");
        //     exit;
        // }
        View::share('setting',Setting::first());
    }
}
