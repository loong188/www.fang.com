<?php

namespace App\Http\Middleware;

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
        if(!auth()->check()){
            return redirect(route('admin.login'))->withErrors(['errors'=>'请登录']);
        }
        return $next($request);
    }
}
