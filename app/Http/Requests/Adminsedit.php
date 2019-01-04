<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Adminsedit extends FormRequest
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
            'username'=>'required',//管理员不能为空   数据库是否已存在同名
            'password'=>'required',
            'repassword'=>'required|same:password',//确认密码
        ];
    }

    // 自定义错误信息
    public function messages(){
        return [
            'username.required'=>'管理员名不能为空',
            'username.unique'=>'管理员重复',
            'password.required'=>'密码不能为空',
            'repassword.required'=>'重复密码不能为空',
            'repassword.same'=>'两次密码不一致',
        ];
    }

}
