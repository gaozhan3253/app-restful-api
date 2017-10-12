<?php

namespace App\Providers;

use App\Facades\Aes\Aes;
use Illuminate\Support\ServiceProvider;

class AesServiceProvider extends ServiceProvider
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
        $this->app->bind('aes',function(){
            return new Aes();
        });
    }
}
