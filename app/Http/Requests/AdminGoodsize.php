<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminGoodsize extends FormRequest
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
            //规则设置 required 输入数据不能为空
            'color'=>'required',
            'store'=>'required'
        ];
    }
    public function messages()
    {
        return [
            //用户名不能为空的规则设置 required 输入数据不能为空
            'color.required'=>'颜色不能为空!',
            'store.required'=>'库存不能为空!'
        ];
    }
}
