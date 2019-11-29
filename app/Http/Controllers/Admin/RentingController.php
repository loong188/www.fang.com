<?php
namespace App\Http\Controllers\Admin;

use App\Models\Renting;
use Illuminate\Http\Request;

class RentingController extends BaseController {
        public function index()
        {
            $data= Renting::paginate($this->pagesize);
            return view('admin.renting.index',compact('data'));
        }
    }