<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminGoodedit extends FormRequest
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
            'descr'=>'required',
            'price'=>'required'
        ];
    }
    public function messages()
    {
        return [
            //用户名不能为空的规则设置 required 输入数据不能为空
            'name.required'=>'商品名不能为空!',
            'type_id.required'=>'类名不能为空!',
            'descr.required'=>'描述不能为空',
            'price.required'=>'价格不能为空'
        ];
    }
}
