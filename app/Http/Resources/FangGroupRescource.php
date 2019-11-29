<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FangGroupRescource extends JsonResource
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
            'gname'=>$this->name,
            'pic'=>$this->icon
        ];
    }
}
