<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adminform extends Model
{
    protected $table = 'adminforms';
    protected $fillable = array('name', 'email', 'password');
}
