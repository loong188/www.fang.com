<?php

namespace App\Models;


class Article extends Base
{
    //dt自定义字段
    protected $appends=['actionBtn','dt'];
    public function cate()
    {
        return $this->belongsTo(Cate::class,'cid');
    }

    public function getActionBtnAttribute()
    {
        return $this->editBtn('admin.article.edit').' '.$this->delBtn('admin.article.destroy');
    }

    public function getPicAttribute()
    {
        if(stristr($this->attributes['pic'],'http')){
            return $this->attributes['pic'];
        }
        return self::$host . '/' . ltrim($this->attributes['pic'],'/');
    }

    public function getDtAttribute()
    {
        return date('Y-m-d',strtotime($this->attributes['created_at']));
    }
}
