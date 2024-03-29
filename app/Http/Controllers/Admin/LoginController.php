<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入邮件类
use Illuminate\Mail\Mailer;
use Mail;
use Illuminate\Mail\Message;


class LoginController extends Controller
{
    public function index(){
//        dump(1);die;
        return view('admin.login.index');
    }
    public function login(Request $request){
        $data= $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);
        $bool=auth()->attempt($data);

//        Mail::raw('登陆成功',function(Message $message){
//            $message->subject('登录通知');
//            $message->to('1046232272@qq.com','小哥');
//        });
        if(!$bool){
            return redirect(route('admin.login'))->withErrors(['error'=>'登录失败']);
        };
        return redirect(route('admin.index'))->with(['success'=>'登录成功']);
    }
}
