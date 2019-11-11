<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
   protected $guarded=[];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=bcrypt($value);
    }
}
