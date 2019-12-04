<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyValidateException;
use App\Http\Resources\FavResourceCollection;
use App\Models\Fav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavController extends Controller
{
    public function isfav(Request $request)
    {
        try{
            $data=$this->validate($request,[
               'openid'=>'required',
                'fang_id'=>'required|numeric'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        $model=Fav::where($data)->first();
        if($model){
            return ['status'=>0,'msg'=>'取消收藏','data'=>1];
        }
        return ['status'=>0,'msg'=>'添加收藏','data'=>0];
    }

    public function fav(Request $request)
    {
        try{
            $data=$this->validate($request,[
               'openid'=>'required',
                'fang_id'=>'required|numeric',
                'add'=>'required|numeric'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        $add=$data['add'];
        unset($data['add']);
        $msg='';
        //判断openID+房源ID唯一性
        $model=Fav::where($data)->first();
        if($add > 0){
            //如果数据库没有则添加
            if(!$model) {
                Fav::create($data);
            }
            $msg='添加收藏成功';
        }else{
            //删除
            if($model) {
                $model->forceDelete();
            }
            $msg='取消收藏成功';
        }
        return ['status'=>0,'msg'=>$msg];
    }

    public function list(Request $request)
    {
        try{
            $data=$this->validate($request,[
                'openid'=>'required'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        $data=Fav::where('openid',$data['openid'])->orderBy('updated_at','asc')->paginate(10);
        return ['status'=>0,'msg'=>'ok','data'=>new FavResourceCollection($data)];
    }
}
