<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fang;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Fangattr;
use App\Models\FangOwner;
use App\Http\Requests\FangRequest;
//use GuzzleHttp\Client;

class FangController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Fang::with('fangowner')->paginate($this->pagesize);
        return view('admin.fang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $url='http://restapi.amap.com/v3/geocode/geo?key=f41305502ac226794c8300e3b7365ace&address=';
//        //引入Guzzle发起get请求
//        $client=new Client(['timeout' => 5,'verify' => false]);
//        $response=$client->get($url);
//        //获取请求的主体
//        $json=(string)$response->getBody();
//        $arr=json_decode($json,true)['geocodes'];
//        if(count($arr)>0){
//            $location=$arr[0]['location'];
//            return $location;
//        }
//        return '';
        //获取省份信息
        $pData=$this->getCity();
        //房源属性
        $attrData=Fangattr::all()->toArray();

        //以字段名为下表创建多层数组
        $attrData=subTree2($attrData);
//        dd($attrData);
        //读取房东
        $fData=FangOwner::all();
//        dd($pData);
        return view('admin.fang.create',compact('pData','attrData','fData'));
    }

    public function getCity($pid = 0)
    {
        $pid = $pid == 0 ? request()->get('pid',0) : $pid;
        return City::where('pid',$pid)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FangRequest $request)
    {

        $data = $request->except(['file', '_token']);
//        dump($data);
        Fang::create($data);
        return redirect(route('admin.fang.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function show(Fang $fang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function edit(Fang $fang)
    {
        $pData=$this->getCity();
        $cData=$this->getCity($fang->fang_province);
        $rData=$this->getCity($fang->fang_city);
        //房源属性
        $attrData=Fangattr::all()->toArray();

        //以字段名为下表创建多层数组
        $attrData=subTree2($attrData);
//        dd($attrData);
        //读取房东
        $fData=FangOwner::all();
//        dd($pData);
        return view('admin.fang.edit',compact('fang','pData','attrData','fData','cData','rData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function update(FangRequest $request, Fang $fang)
    {
        $fang->update($request->except(['_token','_method','file','fang_addr2']));
        return redirect(route('admin.fang.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fang $fang)
    {
        //
    }
}
