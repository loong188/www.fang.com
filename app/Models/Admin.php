<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
   protected $guarded=[];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=bcrypt($value);
    }
}
