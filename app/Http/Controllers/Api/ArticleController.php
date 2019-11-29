<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyValidateException;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCount;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $fields=[
            'id',
            'title',
            'desc',
            'pic',
            'created_at'
        ];
        $data=Article::orderBy('id','asc')->select($fields)->paginate(env('PAGESIZE'));
        return ['status'=>0,'msg'=>'ok','data'=>$data];
    }

    public function show(Article $article)
    {
        return ['status'=>0,'msg'=>'ok','data'=>$article];
    }

    public function history(Request $request)
    {
        try{
            $data=$this->validate($request,[
                'openid'=>'required',
                'art_id'=>'required|numeric'
            ]);
        }catch (\Exception $exception){
            throw new MyValidateException('验证异常',3);
        }
        //获取当前时间
        $data['vdt']=date('Y-m-d');
        $model=ArticleCount::where($data)->first();
//        dump($model);exit;
        if(!$model){
            $data['click']=1;
            $model=ArticleCount::create($data);
        }else{
            $model->increment('click');
        }
        return response()->json(['status'=>0,'msg'=>'记录成功','data'=>$model->click],201);
    }
}
