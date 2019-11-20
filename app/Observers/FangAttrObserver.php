<?php

namespace App\Observers;

use App\Models\FangAttr;

class FangAttrObserver
{
    /**
     * Handle the fang attr "created" event.
     *
     * @param  \App\Models\FangAttr  $fangAttr
     * @return void
     */
    public function creating(FangAttr $fangAttr)
    {
        $field_name=request()->get('field_name');
        $fangAttr->field_name=$field_name == null ? '' : $field_name;
    }
}
