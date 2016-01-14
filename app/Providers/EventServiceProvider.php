<?php

namespace App\Providers;
use App\User;
use Auth;
use App\userDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
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
            $login_user_detail = User::where('id',Auth::user()->id)->get();
            
            foreach($login_user_detail as $val){
             $user_detail_array = [
                 'user_id' => $val->id,
                 'user_type' => $val->user_type,
                 'name' => $val->name,
                 'email' => $val->email
                 ];
            }
            if($user_detail_array['user_type'] == 'attorney'){
                $session_array = [
                                    'attorney_session_array' => [
                                                                'user_id'    => $user_detail_array['user_id'],
                                                                'user_type'  => $user_detail_array['user_type'],
                                                                'name'       => $user_detail_array['name'],
                                                                'email'      => $user_detail_array['email'],
                                                                ]
                                ];
            }elseif($user_detail_array['user_type'] == 'client'){
                 $session_array = [
                                    'client_session_array' => [
                                                                'user_id'    => $user_detail_array['user_id'],
                                                                'user_type'  => $user_detail_array['user_type'],
                                                                'name'       => $user_detail_array['name'],
                                                                'email'      => $user_detail_array['email'],
                                                                ]
                                ];
                
            }elseif($user_detail_array['user_type'] == 'admin'){
                  $session_array = [
                                    'admin_session_array' => [
                                                                'user_id'    => $user_detail_array['user_id'],
                                                                'user_type'  => $user_detail_array['user_type'],
                                                                'name'       => $user_detail_array['name'],
                                                                'email'      => $user_detail_array['email'],
                                                                ]
                                ];
                
            }else{
                 $session_array = ['session' => 'null'];
            }
           //Save session of login user
            Session::put($session_array);
            
            //Fetch session of login user            
//            if( Session::has('admin_session_array') ){
//                $AdminSession = Session::get( 'admin_session_array' );
//                //dd($AdminSession);
//            }elseif(Session::has('client_session_array')){
//                 $ClientSession = Session::get( 'client_session_array' );
//                //dd($ClientSession);
//            }elseif(Session::has('attorney_session_array')){
//                 $AttorneySession = Session::get( 'attorney_session_array' );
//              //dd($AttorneySession);
//            }else{
//                 $DefaultSession = Session::get( 'session' );
//            }
           
        });
        
        $events->listen('Illuminate\Auth\Events\Logout', function() 
        {
            
            $login_user_detail = User::where('id',Auth::user()->id)->get();
            
            foreach($login_user_detail as $val){
             $user_detail_array = [
                 'user_type' => $val->user_type,
                 ];
            }
            if( $user_detail_array['user_type'] == 'client' ){
                
              Session::forget('client_session_array');
            }elseif($user_detail_array['user_type'] == 'attorney'){
                
              Session::forget('attorney_session_array');
            }elseif($user_detail_array['user_type'] == 'admin'){
                
              Session::forget('admin_session_array');
            }else{
                //
            }
        });
          
    }
}
