<?php

namespace App\Http\Resources;

use App\Models\Fangattr;
use Illuminate\Http\Resources\Json\JsonResource;

class FangRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->fang_name,
            'room'=>$this->fang_shi . '室' . $this->fang_ting . '厅',
            'pic'=>$this->fang_pic[0],
            'rent'=>$this->fang_rent,
            'area'=>$this->fang_build_area,
            'direction'=>Fangattr::where('id',$this->fang_direction)->value('name'),
        ];
    }
}
