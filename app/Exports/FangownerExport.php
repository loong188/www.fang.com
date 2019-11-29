<?php

namespace App\Exports;

use App\Models\FangOwner;
use Maatwebsite\Excel\Concerns\FromCollection;

class FangownerExport implements FromCollection
{
    public $offset;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($offset== 0)
    {
        $this->offset=$offset;
    }
    public function collection(){
        return FangOwner::offset($this->offset)->limit(1000)->get();
}
}
