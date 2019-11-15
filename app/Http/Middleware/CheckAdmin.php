<?php

namespace App\Http\Middleware;
use App\Models\Role;
use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //$params获取中间件传过来的参数
    public function handle($request, Closure $next,$params)
    {
        //判断是否登录
        if(!auth()->check()){
            return redirect(route('admin.login'))->withErrors(['errors'=>'请登录']);
        }
        //当前用户角色模型
        $userModel=auth()->user();
        //根据角色Id查寻角色
        //原始 first后面能接where条件，find后面不能写where
        //$roleModel=auth()->user()->role()->first();
        //简写
        $roleModel= $userModel->role;
        //使用关联模型获取对应的权限
        $auths=$roleModel->nodes()->pluck('route_name','id')->toArray();
        $authList= array_filter($auths);
//        dump($authList);die;
        //放行权限
        $allowList=[
          'admin.index',
            'admin.logout',
            'admin.welcome'
        ];
        $authList=array_merge($authList,$allowList);
//        dd($authList);
        //把权限写到request对象的auths里面
        $request -> auths = $authList;
        //获取路由别名
        $currentRouteName=$request->route()->getName();
        //获取当前用户名
        $currentUsername=auth()->user()->username;
        //保存当前用户名，中间件传过来的traits按钮对象所要用的数据
        $request->username=$currentUsername;
        //判断有没有权限
        if(!in_array($currentRouteName,$authList) && $currentUsername != 'admin'){
            exit('你没有权限');
        }

        return $next($request);
    }
}
