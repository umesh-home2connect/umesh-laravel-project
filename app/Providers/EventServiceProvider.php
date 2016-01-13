<?php

namespace App\Providers;
use App\User;
use Auth;
use App\userDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
//        'App\Events\Login' => ['App\Listeners\logsuccessfullogin',],
       
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        
        $events->listen('Illuminate\Auth\Events\Login', function() 
        {
            $login_data = ['login_time' => Carbon::now()];
            User::where('id',Auth::user()->id)->update(['last_login' => Carbon::now()]);
            userDetail::where('user_id',Auth::user()->id)->update($login_data);
           
        });
    }
}
