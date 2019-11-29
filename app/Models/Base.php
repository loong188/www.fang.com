<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Btn;
class Base extends Model
{
    use SoftDeletes,Btn;
    protected $guarded=[];
    protected $dates=['deleted_at'];
    protected static $host;
    protected static function boot()
    {
        parent::boot();
        self::$host='http://www.fang.com';
    }

}