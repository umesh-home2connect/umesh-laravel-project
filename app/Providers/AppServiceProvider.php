<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\FileUploadPath;
class AppServiceProvider extends ServiceProvider
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
//         if ($this->app->environment() == 'production') {
//        $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
//    }
//        dd('test');
        
          $this->app->singleton('App\Helpers\Contracts\FileUploadContract', function () {
            return new FileUploadPath();
        });
    }
    
     public function provides() {
        return ['App\Helpers\Contracts\FileUploadContract'];
    }
    
    
}
