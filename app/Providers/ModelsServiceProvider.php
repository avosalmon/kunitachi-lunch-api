<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Shops\Shops;
use App\Models\Shops\ShopsEloquent;

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
        $this->app->bind('App\Models\Shops\Shops', function () {
            return new Shops(
                new ShopsEloquent
            );
        });
    }
}
