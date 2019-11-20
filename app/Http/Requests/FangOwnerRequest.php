<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
class FangOwnerRequest extends FormRequest
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
        $this->addRules();
        return [
           'name'=>'required',
            'sex'=>'required',
            'age'=>'required',
            'phone'=>'required|checkPhone',
            'card'=>'required|checkCard',
            'address'=>'required',
            'pic'=>'required',
            'email'=>'required'
            ];
    }
    public function messages()
    {
        return [
            'name.required'=>'房东姓名不能为空',
            'sex.required'=>'性别不能为空',
            'age.required'=>'年龄不能为空',
            'address.required'=>'地址不能为空',
            'phone.check_phone'=>'不合法的手机号',
            'phone.required'=>'手机号不能为空',
            'card.check_card'=>'不合法的身份证号码',
            'card.required'=>'身份证号码不能为空',
            'pic.required'=>'身份证照片不能为空',
            'email.required'=>'邮箱不能为空'
        ];
    }
    private function addRules(){
        Validator::extend('checkPhone',function ($attribute,$value,$parameters,$validator){
            $reg='/^1[3456789]\d{9}$/';
            return preg_match($reg,$value);
        });
        Validator::extend('checkCard',function ($attribute,$value,$parameters,$validator){
            $card=trim($value);
            $reg='/^[1-9][0-9]{5}([1][9][0-9]{2}|[2][0][0|1][0-9])([0][1-9]|[1][0|1|2])([0][1-9]|[1|2][0-9]|[3][0|1])[0-9]{3}([0-9]|[X|x])$/';
            return preg_match($reg,$card);
        });
    }
}
