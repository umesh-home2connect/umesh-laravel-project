<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userDetail extends Model
{
    protected $table = 'userdetails';
    protected $fillable = ['user_id','phone_number','login_time'];
    
    public function user()
     {
        return $this->belongsTo(User::class);
     }
    
}
