<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Http\Requests\ArticleAddRequest;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   //判断是否是ajax请求
        if($request->ajax()){
            //获取总条数
//        $count = Article::count();
        //分页
        $offset = $request->get('start',0);
         //获取记录条数
        $limit = $request->get('length',$this->pagesize);
            //排序
        $order=$request->get('order')[0];
            //排序字段
        $columns=$request->get('columns')[$order['column']];
        //排序规则
        $orderType=$order['dir'];
            //排序字段
        $field=$columns['data'];
        //搜索
        $kw = $request->get('kw');
        $builer = Article::when($kw,function ($query) use ($kw){
            $query->where('title','like',"%{$kw}%");
        });
            //获取记录总数
        $count = $builer->count();
        //服务端分页
        $data = $builer->with('cate')->orderBy($field,$orderType)->offset($offset)->limit($limit)->get();
        return [
              //客户端调用服务端次数标识
            'draw' => $request->get('draw'),
            //获取数据记录总条数
            'recordsTotal' => $count,
            //数据过滤后的总条数
            'recordsFiltered' => $count,
            //数据
            'data' => $data
        ];

        }
        return view('admin.article.index');
    }

//    public function show()
//    {
//
//    }
    public function upfile(Request $request)
    {
        $file=$request->file('file');
        $uri=$file->store('','article');
        return ['status'=>0,'url'=>'/uploads/articles/'.$uri];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cateData=Cate::all()->toArray();
        $cateData=treeLevel($cateData);
//        dd($cateData);die;
        return view('admin.article.create',compact('cateData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleAddRequest $request)
    {
        $data=$request->except(['_token','file']);
        Article::create($data);
        return redirect(route('admin.article.index'));
    }
    public function edit(Request $request, Article $article)
    {
        $url_query=$request->all();
        $cateData = Cate::all()->toArray();
        $cateData = treeLevel($cateData);
        return view('admin.article.edit',compact('cateData','article','url_query'));
    }

    public function delfile(Request $request)
    {
        $id = $request->get('id');
        $src = $request->get('src');
        $filepath = public_path($src);
        if(is_file($filepath)){
            unlink($filepath);
        }
        return ['status' => 0, 'msg' => '删除成功'];
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleAddRequest $request, Article $article)
    {
        $url = $request->get('url');
        $article->update($request->except(['file','_method','_token','url']));
        $url=route('admin.article.index').'?'.http_build_query($url);
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return ['status'=>0,'msg'=>'删除成功'];
    }
}
