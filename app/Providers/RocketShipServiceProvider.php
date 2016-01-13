<?php

namespace App\Providers;
use App\Helpers\RocketShip;
use Illuminate\Support\ServiceProvider;
//use App\Helpers\FileUploadPath;
class RocketShipServiceProvider extends ServiceProvider
{
    
    protected $defer = True;
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
        $this->app->singleton('App\Helpers\Contracts\RocketShipContract',function(){
            return new RocketShip();
        });
        
//          $this->app->singleton('App\Helpers\Contracts\FileUploadContract',function(){
//            return new FileUploadPath();
//        });
    }
    
    public function provides() {
        return ['App\Helpers\Contracts\RocketShipContract'];
    }
}
