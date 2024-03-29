<?php
namespace App\Models\Traits;

trait Btn{
    private function checkAuth(string $routeName) {

        //在中间件中获取当前角色权限
        $auths=request()->auths ?? [];

        if(!in_array($routeName,$auths) && request()->username !='admin'){
            return false;
        }
        return true;
    }

    public function editBtn(string $routeName)
    {
        if($this->checkAuth($routeName)){
            $arr['start']=request()->get('start') ?? 0;
            $arr['field']=request()->get('order')[0]['column'];
            $arr['order'] = request()->get('order')[0]['dir'];
            $params=http_build_query($arr);
            $url=route($routeName,$this);
            if(stristr($url,'?')){
                $url=$url.'&'.$params;
            }else{
                $url=$url.'?'.$params;
            }
            return '<a href="'.$url.'" class="label label-secondary radius">修改</a>';
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

    public function showBtn(string $routeName)
    {
        if($this->checkAuth($routeName)){
            return '<a href="'.route($routeName,$this).'" class="label label-success radius showBtn">查看</a>';
        }
        return '';
    }
}