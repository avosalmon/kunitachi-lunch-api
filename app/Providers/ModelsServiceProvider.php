<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Stores\Stores;
use App\Models\Stores\StoresEloquent;

class ModelsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Models\Stores\Stores', function () {
            return new Stores(
                new StoresEloquent
            );
        });
    }
}
