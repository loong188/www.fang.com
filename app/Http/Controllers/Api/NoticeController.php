<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyValidateException;
use App\Models\Notice;
use App\Models\Renting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use QL\QueryList;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        try{
            $data=$this->validate($request,[
                'openid'=>'required'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
//        dump($data);exit;
        $renting_id=Renting::where($data)->value('id');
        $data=Notice::with('fangowner:id,name,phone')->where('renting_id',$renting_id)->orderBy('id','asc')->paginate(env('PAGESIZE'));
//        print_r($renting_id); exit;
        return ['status'=>0,'msg'=>'ok','data'=>$data];
    }

    public function sipder()
    {
//        echo 111;
//        $data = QueryList::Query('https://news.ke.com/bj/baike/0269254.html',[
//            'title'=>['title','text']
//        ])->getData();
//        //打印结果
//        dump($data);
        QueryList::run('Multi',[
            //待采集链接集合
            'list' => [
                'https://news.ke.com/bj/baike/033/pg1/',
                'https://news.ke.com/bj/baike/033/pg2/',
                'https://news.ke.com/bj/baike/033/pg3/'
                //更多的采集链接....
            ],
            'curl' => [
                'opt' => array(
                    //这里根据自身需求设置curl参数
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_AUTOREFERER => true,
                    //........
                ),
                //设置线程数
                'maxThread' => 100,
                //设置最大尝试数
                'maxTry' => 10
            ],
            'success' => function($ret){
                //采集规则
                $reg =[
                    //采集文章标题
                    'title' => ['.text .tit','text'],
                    'desc'=>['.text .summary','text'],
                    'pic'=>['.item .img img ','data-original'],
                    'time'=>['.text .info .time','text']
                ];
                $rang = '.content';
                $ql = QueryList::Query($ret['content'],$reg);
                $data = $ql->getData();
                //打印结果，实际操作中这里应该做入数据库操作
                dump($data);
            }
        ]);


    }

}
