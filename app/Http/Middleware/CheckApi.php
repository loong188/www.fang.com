<?php
namespace App\Http\Middleware;

use Closure;

class CheckApi{
    public function handle($request,Closure $next)
    {
        $username=$request->header('username');
        $password=$request->header('password');
        $sign=$request->header('sign');
        $timstamp=$request->header('timstamp');
        //根据账号登录
        $bool=auth()->guard('api')->attempt(['username'=>$username,'password'=>$password]);
        if(!$bool){
            return response()->json(['status'=>100,'msg'=>'登录验证异常','data'=>[]],401);
        }
        $token=auth()->guard('api')->user()->token;
        //验签
        $signate=md5($username.$token.$password.$timstamp);
        if($signate !=$sign){
            return response()->json(['status'=>100,'msg'=>'登录验证异常！','data'=>[]],401);
        }
        return $next($request);
    }
}