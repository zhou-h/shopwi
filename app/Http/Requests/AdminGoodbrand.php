<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminGoodbrand extends FormRequest
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
            //用户名不能为空的规则设置 required 输入数据不能为空
            'name'=>'required',
            'type_id'=>'required',
            'good_id'=>'required',
            'logo'=>'required'
        ];
    }
    public function messages()
    {
        return [
            //用户名不能为空的规则设置 required 输入数据不能为空
            'name.required'=>'商品名不能为空!',
            'type_id.required'=>'类名不能为空!',
            'good_id.required'=>'不能为空',
            'logo.required'=>'logo不能为空'
        ];
    }
}
