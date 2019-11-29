<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
// 软删除  导入类
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Btn;
class Apiuser extends Authenticatable
{
    use SoftDeletes,Btn;
    // 指定软删除字段 deleted_at 数据表中的字段
    protected $dates = ['deleted_at'];
    // create添加时所用
    protected $guarded = [];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=bcrypt($value);
        $this->attributes['plainpass']=$value;
    }
}
