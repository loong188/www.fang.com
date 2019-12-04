<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FangGroupRescourceCollection;
use App\Models\Fang;
use App\Models\Fangattr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FangRescource;
use App\Http\Resources\FangRescourceCollection;

class FangController extends Controller
{
    public function recommend()
    {
        $data=Fang::where('is_recommend','1')->orderBy('updated_at','desc')->limit(5)->get(['id','fang_name','fang_pic','fang_build_area','fang_rent','fang_shi','fang_ting']);
        return ['status'=>0,'msg'=>'获取成功','data'=>$data];
    }

    public function group(Request $request)
    {
        //字段名称
        $where['field_name']='fang_group';
        //上级id号
        $pid=Fangattr::where($where)->value('id');
        $data=Fangattr::where('pid',$pid)->orderBy('updated_at','desc')->limit(4)->get();
        return ['status'=>0, 'msg'=> 'ok', 'data'=>new FangGroupRescourceCollection($data)];
    }

    public function fanglist(Request $request)
    {
        $data=Fang::orderBy('id','asc')->paginate(10);
        return ['status'=>0, 'msg'=>'ok', 'data'=>new FangRescourceCollection($data)];
    }

    public function detail(Request $request)
    {
    $data=Fang::with('fangowner:id,name,phone')->where('id',$request->get('id'))->first();
        $data['fang_config']=explode(',',$data['fang_config']);
        $data['fang_config']=Fangattr::whereIn('id',$data['fang_config'])->pluck('name');
        $data['fang_direction']=Fangattr::where('id',$data['fang_direction'])->value('name');
        return ['status'=>0, 'msg'=>'ok', 'data'=>$data];
    }

    public function attr(Request $request)
    {
        $attrData=Fangattr::all()->toArray();
        $attrData=subTree2($attrData);
        return ['status'=>0,'msg'=>'ok','data'=>$attrData];
    }

    public function search(Request $request)
    {
        $kw=$request->get('kw');
        if(empty($kw)){
            $data=Fang::orderBy('id','asc')->paginate(10);
            return ['status'=>0, 'msg'=>'ok', 'data'=>new FangRescourceCollection($data)];
        }
        $client = \Elasticsearch\ClientBuilder::create()->setHosts(config('es.hosts'))->build();
        $params = [
            'index' => 'fangs',
            'body' => [
                'query' => [
                    'match' => [
                        'xiaoqu'=>[
                            'query' => $kw
                        ]
                    ]
                ]
            ]
        ];
        $ret = $client->search($params);
//        dump($ret);
        $total=$ret['hits']['total']['value'];
        if($total == 0){
            return ['status'=>6,'msg'=>'没有检测到数据','data'=>[]];
        }
        $data=array_column($ret['hits']['hits'],'_id');
        $data=Fang::whereIn('id',$data)->orderBy('id','asc')->paginate(10);
        return ['status'=>0,'msg'=>'ok','data'=>new FangRescourceCollection($data)];
    }
}
