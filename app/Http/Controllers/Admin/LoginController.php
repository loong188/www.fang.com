<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
//        dump(1);
        return view('admin.login.index');
    }
    public function login(Request $request){
        $data= $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);
        $bool=auth()->attempt($data);
        if(!$bool){
            return redirect(route('admin.login'))->withErrors(['error'=>'登录失败']);
        };
        return redirect(route('admin.index'))->with(['success'=>'登录成功']);
    }
}
