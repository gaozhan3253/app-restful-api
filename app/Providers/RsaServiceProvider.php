<?php

namespace App\Providers;

use App\Facades\Rsa\Rsa;
use Illuminate\Support\ServiceProvider;

class RsaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('rsa',function(){
            return new Rsa();
        });
    }
}
