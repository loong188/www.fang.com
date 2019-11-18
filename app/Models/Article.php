<?php

namespace App\Models;


class Article extends Base
{
    protected $appends=['actionBtn'];
    public function cate()
    {
        return $this->belongsTo(Cate::class,'cid');
    }

    public function getActionBtnAttribute()
    {
        return $this->editBtn('admin.article.edit').' '.$this->delBtn('admin.article.destroy');
    }
}
