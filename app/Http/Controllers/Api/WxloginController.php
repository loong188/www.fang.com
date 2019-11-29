<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyValidateException;
use App\Models\Renting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WxloginController extends Controller
{
    public function login(Request $request)
    {
        $code=$request->get('code');
        $appid=config('wx.appid');
        $secret=config('wx.secret');
        $url=sprintf(config('wx.wxloginUrl'),$appid,$secret,$code);
        //发起一个Get请求

        $client=new Client(['timeout'=>5,'verify'=>false]);

        $response=$client->get($url);

        //请求响应值
        $json=(string)$response->getBody();

        $arr=json_decode($json,true);
//                dump($arr);exit;
        $openid = $arr['openid'] ?? 'none';

        if($openid!='none'){
            $info=Renting::where('openid',$openid)->value('openid');
            if(!$info){
                Renting::create(['openid'=>$openid]);
            }
        }
        return ['openid'=>$openid];
    }

    public function userinfo(Request $request)
    {
//        dump($request);exit;
        try{
            $data=$this->validate($request,[
                'openid'=>'required',
                'nickname'=>'required',
//                'sex'=>'required|in:男,女',
                'avatar'=>'required'
            ]);
        }catch (\Exception $exception) {
            throw new MyValidateException('验证不通过',3);
        }
        $model = Renting::where('openid',$data['openid'])->first();
        if(!$model){
            Renting::create($data);
        }else{
            $model->update($data);
        }
        return ['status'=>0,'msg'=>'成功'];
    }
}
