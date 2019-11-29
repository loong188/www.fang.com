<?php

namespace App\Models;

use App\Observers\FangObserver;
class Fang extends Base
{
    protected static function boot()
    {
        parent::boot();
        self::observe(FangObserver::class);
    }

    public function fangowner()
    {
        return $this->belongsTo(FangOwner::class,'fang_owner');
    }

    public function getAttrIdByName($id)
    {
        if(!is_array($id)){
            return Fangattr::where('id',$id)->value('name');
        }
        $names=Fangattr::whereIn('id',$id)->pluck('name')->toArray();
        return implode(',',$names);
    }
    public function getPicAttribute()
    {
        $arr=explode('#',$this->attributes['fang_pic']);
        array_shift($arr);
        return $arr;
    }

    public function getFangPicAttribute()
    {
        $arr=explode('#',$this->attributes['fang_pic']);
        //去除掉第一个元素
        array_shift($arr);
        return array_map(function ($item){
        return self::$host . '/' . ltrim($item,'/');
        },$arr);
    }
}
