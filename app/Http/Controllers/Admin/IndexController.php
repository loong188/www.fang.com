<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Node;

class IndexController extends BaseController
{
    public function __construct()
    {
        
    }
    public function index()
    {
        //获取闪存存到闪存
        session()->flash('success',session('success'));
        //登录用户信息
        $userModel = auth()->user();
        //对应角色关联属于
        $roleModel = $userModel->role;
        if($userModel->username != 'admin'){
            //普通用户
            $nodeData = $roleModel->nodes()->where('is_menu','1')->get(['id','pid','name','route_name'])->toArray();
        }else{
            //超级管理员
            $nodeData=Node::where('is_menu','1')->get(['id','pid','name','route_name'])->toArray();
        }
        $menuData=subTree($nodeData);
//        dump($menuData);die;
        return view('admin.index.index',compact('menuData'));
    }

    public function welcome()
    {
        $datas=$_SERVER;
        $user=auth()->user();
        $user=$user['username'];
        $count1=Fang::where('fang_status',1)->count();
        $count2=Fang::where('fang_status',0)->count();
        $legend="'已租','待租'";
        $data=[
            ['value'=>$count1,'name'=>'已租'],
            ['value'=>$count2,'name'=>'待租']
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);


        return view('admin.index.welcome',compact('data','datas','legend','user'));
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
