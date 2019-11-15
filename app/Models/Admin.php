<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
//引入traits
use App\Models\Traits\Btn;

class Admin extends Authenticatable
{
    use SoftDeletes,Btn;
    protected $dates=['deleted_at'];
   protected $guarded=[];

    public function role()
    {
                                //关联模型   //模型对应id
        return $this->belongsTo(Role::class,'role_id');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=bcrypt($value);
    }
}
