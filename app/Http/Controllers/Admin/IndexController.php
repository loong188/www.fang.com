<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class IndexController extends BaseController
{
    public function index()
    {

        return view('admin.index.index',compact('data'));
    }

    public function welcome()
    {
        $data=$_SERVER;
        $user=auth()->user();
        $user=$user['username'];
////        $data[]=$data['REQUEST_TIME'];
//        $data=$data['REMOTE_ADDR'];
//        dump($data);
//        dump($user);


        return view('admin.index.welcome',compact('data','user'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('admin.login'))->with(['success'=>'退出成功']);
    }

    public function edit(){
        $data=auth()->user();
        return view('admin.index.edit',compact('data'));
    }
    public function update(Request $request,int $id)
    {
        $data=$this->validate($request,[
                'password'=>'required|confirmed'
        ]);
        $data['password'] = bcrypt($data['password']);
        Admin::where('id',$id)->update($data);
        return redirect(route('admin.index'))->with('success','修改密码成功 ');
    }
}
