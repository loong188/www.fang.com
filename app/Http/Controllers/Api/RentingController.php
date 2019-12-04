<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyValidateException;
use App\Exceptions\loginException;
use App\Models\Fang;
use App\Models\Renting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Exception\LogicException;

class RentingController extends Controller
{
    public function upfile(Request $request)
    {
        $file = $request->file('cardimg');
        $info = $file->store('card', 'renting');
//        dump($info);exit;
        return ['status'=>0,'path'=>'/uploads/renting/'.$info];
    }

    public function editrenting(Request $request)
    {
        try{
            $this->validate($request,[
                'openid'=>'required'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        //获取所有传进来数据
        $data=$request->all();
//        dump($data);exit;
        $model=Renting::where('openid',$data['openid'])->first();
        if(!$model) throw new loginException('没有查询到此信息',4);
        $model->update($data);
        return ['status'=>0,'msg'=>'更新用户信息成功'];
    }

    public function show(Request $request)
    {
        try{
            $data=$this->validate($request,[
                'openid'=>'required',
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        //根据openID来查询有没有数据，如果有返回模型对象
        $model=Renting::where('openid',$data['openid'])->first();
        if(!$model) throw new LoginException('没有查询到此信息',4);
        return ['status'=>0,'msg'=>'成功','data'=>$model];
    }

    public function deletepic(Request $request)
    {
        $data=$request->all();
        $res=$data['id'];

        if(stristr($res,'http')){
          $res=substr($res ,19);
        $ret=Renting::where('openid',$data['openid'])->value('card_img');
            foreach ($ret as $item ){
                $btn=substr($item ,19);
                if($btn==$res){
                    $filepath = public_path($btn);
                    unlink($filepath);
                }

            }



//            array_map(function ($item){
//                $ress=substr($item ,19);
////                dump($ress);
//                if($ress==$res){
//                    dump($ress);
//                }
//            },$ret);
        }
    }
}
