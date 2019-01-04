<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminTypeinsert extends FormRequest
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
            //不能为空的规则设置 required 输入数据不能为空
            'name'=>'required'
        ];
    }
    public function messages()
    {
        return [
            //不能为空的规则设置 required 输入数据不能为空
            'name.required'=>'属性名不能为空!'
        ];
    }
}
