<?php

namespace App\Http\Controllers\Admin;

use App\Models\FangAttr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FangAttrRequest;

class FangAttrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data=FangAttr::all()->toArray();
            $data=treeLevel($data);
            return $data;
        }
        return view('admin.fangattr.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=FangAttr::where('pid',0)->pluck('name','id')->toArray();
        $data[0]='==顶级==';
        ksort($data);
        return view('admin.fangattr.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FangAttrRequest $request)
    {
        $data= $request->except(['file','_token']);
//        dd($data);
        FangAttr::create($data);
        return redirect(route('admin.fangattr.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FangAttr  $fangAttr
     * @return \Illuminate\Http\Response
     */
    public function show(FangAttr $fangAttr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FangAttr  $fangAttr
     * @return \Illuminate\Http\Response
     */
    public function edit(FangAttr $fangAttr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FangAttr  $fangAttr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FangAttr $fangAttr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FangAttr  $fangAttr
     * @return \Illuminate\Http\Response
     */
    public function destroy(FangAttr $fangAttr)
    {
        //
    }
}
