<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BaseController extends Controller{
    protected $pagesize=1;

    public function __construct()
    {
        $this->pagesize= env('PAGESIZE');
    }
    public function upfile(Request $request)
    {

        $nodeName=$request->get('node');
        $file=$request->file('file');
        $uri=$file->store('',$nodeName);
        return ['status'=>0,'url'=>'/uploads/'.$nodeName.'/'.$uri];
    }
}