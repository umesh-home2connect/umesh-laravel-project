<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editprofile extends Model
{
    protected $fillable = ['description','user_id'];
    
    public function user()
       {
        return $this->belongsTo(User::class);
       }
}
