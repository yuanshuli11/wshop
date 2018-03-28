<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 数据库语句记录
        \DB::listen(function ($query) {
            \Log::info($query->sql);
            \Log::info($query->bindings);
        });
        //监听
       # \App\Services\Listener\CityListener::Listener(); //文章添加记录
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
