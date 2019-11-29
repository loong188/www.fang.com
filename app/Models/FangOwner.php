<?php

namespace App\Models;

use App\Observers\FangOwnerOberver;

class FangOwner extends Base
{
    protected static function boot()
    {
        parent::boot();
        self::observe(FangOwnerOberver::class);
    }

}
