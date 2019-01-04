<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLink extends FormRequest
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
            //电话
            'phone'=>'required|regex:/\d{11}/',
            //url
            'url'=>'required|url',
             //name
            'name'=>'required',
            //title
            'title'=>'required',
            //name
            'type'=>'required',
            //status
            'status'=>'required',
            //logo
            'logo'=>'required'
        ];
    }

     //自定义错误
   public function messages(){
        return[
    //电话
        'phone.required'=>'电话不能为空',
        'phone.regex'=>'电话不符合规则',
    // url
        'url.required'=>'url不能为空',
        'url.url'=>'url格式不对',
    // name
        'name.required'=>'联系人不能为空',
    // logo
        'logo.required'=>'logo不能为空',
    // status
        'status.required'=>'状态不能为空',
    // title
        'title.required'=>'标题不能为空',
    // type
        'type.required'=>'类型不能为空'
        ];
    }
}
