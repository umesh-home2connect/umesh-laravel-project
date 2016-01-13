<?php

namespace App\Policies;
use App\User;
use App\Editprofile;
use Illuminate\Auth\Access\HandlesAuthorization;

class EditprofilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        //
//    }
    
    public function update_editprofile(User $user , Editprofile $edit)
        {
        return $user->id == $edit->user_id;
    }
}
