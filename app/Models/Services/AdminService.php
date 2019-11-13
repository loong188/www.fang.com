<?php
namespace App\Models\Services;

use Illuminate\Http\Request;
use App\Models\Admin;
class AdminService {
    public function getList(Request $request,int $pagesize=10)
    {
        $userid=auth()->id();
        $st=$request->get('st');
        $et=$request->get('et');
        $kw=$request->get('kw');
        return Admin::when($st,function($query) use ($st,$et){
            $st = date('Y-m-d 00:00:00',strtotime($st));
            $et = date('Y-m-d 23:59:59',strtotime($et));
            $query->whereBetween('created_at',[$st,$et]);
        })->when($kw,function ($query) use ($kw){
            $query->where('username','like',"%{$kw}%");
        })->where('id','!=',$userid)->orderBy('id','desc')->withTrashed()->paginate($pagesize);
    }
}