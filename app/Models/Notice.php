<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Base
{
    public function fangowner()
    {
        return $this->belongsTo(FangOwner::class,'fangowner_id');
    }

    public function renting()
    {
        return $this->belongsTo(Renting::class,'renting_id');
    }
}
