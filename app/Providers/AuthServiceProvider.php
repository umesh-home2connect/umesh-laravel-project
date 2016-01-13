<?php

namespace App\Providers;
use App\Task;
use App\Policies\TaskPolicy;
use App\Editprofile;
use App\Policies\EditprofilePolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
          Task::class => TaskPolicy::class,
//          Editprofile::class => EditprofilePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
       
//         $gate->define('destroy', function ($user, $task) {
//            return $user->id == $task->user_id;
//        });
//        $gate->define('destroy', 'TaskController@destroy');
    }
}
