<?php

namespace App\Listners;

use App\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class logsuccessfullogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  login  $event
     * @return void
     */
    public function handle(Login $event)
    {
       $login_data = ['login_time' => Carbon::now()];
       $event->user->last_login = date('Y-m-d H:i:s');
       $event->user->save();
       //$event->userDetail::
        
       // userDetail::where('user_id',Auth::user()->id)->update($login_data);
    }
}
