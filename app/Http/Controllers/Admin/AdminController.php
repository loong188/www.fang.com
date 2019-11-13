<?php

namespace App\Http\Controllers\Admin;

use App\Models\Services\AdminService;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends BaseController
{
    public function index(Request $request)
    {
        $data= (new AdminService())->getList($request,$this->pagesize);
        return view('admin.admin.index',compact('data'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|unique:admins,username',
            'truename'=>'required',
            'email'=>'nullable|email',
            'password'=>'required|confirmed',
        ]);
        $data=$request->except(['_token','password_confirmation']);
        $model=Admin::create($data);
        return redirect(route('admin.user.index'))->with('success','添加用户【'.$model->truename.'】成功');

    }

    public function edit(int $id)
    {
        $data=Admin::find($id);
        return view('admin.admin.edit',compact('data'));
    }
    public function update(Request $request,int $id)
    {
        $data=$this->validate($request,[
            'username'=>'required|unique:admins,username,'.$id,
            'truename'=>'required',
            'email'=>'nullable|email',
            'password'=>'nullable|confirmed',
            'phone'=>'nullable|min:11',
            'sex'=>'in:先生,女士'
        ]);
        if(!$data['password']){
            unset($data['password']);
        }
        Admin::where('id',$id)->update($data);
        return redirect(route('admin.user.index'))->with('success','修改用户【'.$data['truename'].'】成功 ');
    }

    public function destroy(int $id)
    {
        Admin::destroy($id);
        return ['status'=>0,'msg'=>'删除成功'];
    }
    public function delall(Request $request){
        $ids=$request->get('ids');
        Admin::destroy($ids);
        return ['status'=>0,'msg'=>'删除成功'];
    }

    public function restore(Request $request)
    {
        $id=$request->get('id');
        Admin::where('id',$id)->onlyTrashed()->restore();
        return ['status'=>0,'msg'=>'成功'];
    }
}
