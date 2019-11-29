<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fang_name'=>'required',
            'fang_xiaoqu'=>'required',
            'fang_desn'=>'required',
            'fang_province'=>'required|numeric|min:1',
            'fang_addr'=>'required',
            'fang_direction'=>'required',
            'fang_build_area'=>'required',
            'fang_using_area'=>'required',
            'fang_year'=>'required',
            'fang_rent'=>'required',
            'fang_floor'=>'required',
            'fang_shi'=>'required',
            'fang_ting'=>'required',
            'fang_wei'=>'required',
            'fang_pic'=>'required',
            'fang_rent_class'=>'required',
            'fang_config'=>'required',
            'fang_area'=>'required',
            'fang_rent_range'=>'required',
            'fang_rent_type'=>'required',
            'fang_status'=>'required',
            'fang_owner'=>'required',
            'fang_body'=>'required',
            'fang_group'=>'required',
            'is_recommend'=>'required',
            'fang_city'=>'required|numeric|min:1',
            'fang_region'=>'required|numeric|min:1',

        ];
    }

    public function messages()
    {
        return [
          'fang_province.required'=>'省份必须填',
            'fang_province.min'=>'选择一下省份',
            'fang_name.required'=>'房源名称必须填',
            'fang_xiaoqu.required'=>'房源小区必须填',
            'fang_city.required'=>'市必须填',
            'fang_region.required'=>'区必须填',
            'fang_addr.required'=>'房源地址必须填',
            'fang_direction.required'=>'房源朝向必须填',
            'fang_build_area.required'=>'房源面积必须填',
            'fang_using_area.required'=>'使用面积必须填',
            'fang_year.required'=>'建筑年代必须填',
            'fang_rent.required'=>'租金必须填',
            'fang_floor.required'=>'楼层必须填',
            'fang_shi.required'=>'几室必须填',
            'fang_ting.required'=>'几厅必须填',
            'fang_wei.required'=>'几卫必须填',
            'fang_pic.required'=>'房屋图片必须填',
            'fang_rent_class.required'=>'租凭方式必须填',
            'fang_config.required'=>'配套设施必须填',
            'fang_area.required'=>'区域必须填',
            'fang_rent_range.required'=>'租金范围必须填',
            'fang_rent_type.required'=>'租期方式必须填',
            'fang_status.required'=>'房源状态必须填',
            'fang_owner.required'=>'业主必须填',
            'fang_desn.required'=>'房源描述必须填',
            'fang_body.required'=>'房源信息必须填',
            'fang_group.required'=>'房源小组必须填',
            'is_recommend.required'=>'是否推荐必须填'
        ];
    }
}
