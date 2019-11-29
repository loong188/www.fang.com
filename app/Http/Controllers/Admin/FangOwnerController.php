<?php

namespace App\Http\Controllers\Admin;

use App\Models\FangOwner;
use Illuminate\Http\Request;
use App\Http\Requests\FangOwnerRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FangownerExport;
class FangOwnerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo 111;die;
        $excelpath=public_path('/uploads/fangownerexcel/fangowner.xlsx');
        $isshow=file_exists($excelpath) ? true : false;
        $data=FangOwner::orderBy('id','desc')->paginate($this->pagesize);
        return view('admin.fangowner.index')->with(['data'=>$data,'isshow'=>$isshow]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.fangowner.create');
    }

    public function export()
    {
        $obj=Excel::store(new FangownerExport(),'fangowner.xlsx','fangownerexcel');
        if($obj==true){
            dump('导出成功');
            return redirect(route('admin.fangowner.index'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FangOwnerRequest $request)
    {
        $data=$request->except(['file','_token']);
        FangOwner::create($data);
        return redirect(route('admin.fangowner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function show(FangOwner $fangowner)
    {
//        dump($fang)
        $pics=$fangowner->pic;
        $picList=explode('#',$pics);
        if(count($picList)<=1){
            return ['status'=>1,'msg'=>'没有图片','data'=>[]];
        }
        array_shift($picList);
        return ['status'=>0,'msg'=>'成功','data'=>$picList];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(FangOwner $fangOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FangOwner $fangOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(FangOwner $fangOwner)
    {
        //
    }
}
