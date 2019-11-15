<?php
namespace App\Models\Traits;

trait Btn{
    private function checkAuth(string $routeName) {
        //在中间件中获取权限
        $auths=request()->auths;

        if(!in_array($routeName,$auths) && request()->username !='admin'){
            return false;
        }
        return true;
    }

    public function editBtn(string $routeName)
    {
        if($this->checkAuth($routeName)){
            return '<a href="'.route($routeName,$this).'" class="label label-secondary radius">修改</a>';
        }
        return '';
    }
    public function delBtn(string $routeName)
    {
        if($this->checkAuth($routeName)){
            return '<a href="'.route($routeName,$this).'" class="label label-secondary deluser">删除</a>';
        }
        return '';
    }
}