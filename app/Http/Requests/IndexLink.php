<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexLink extends FormRequest
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
            'phone'=>'required|unique:friendly_link|regex:/\d{11}/',
            //url
            'url'=>'required|url|unique:friendly_link',
             //name
            'name'=>'required',
            //title
            'title'=>'required|unique:friendly_link',
            //name
            'type'=>'required',
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
        'phone.unique'=>'电话已存在',
    // url
        'url.required'=>'url不能为空',
        'url.url'=>'url格式不对',
        'url.unique'=>'电话已存在',
    // name
        'name.required'=>'联系人不能为空',
    // logo
        'logo.required'=>'请选择上传文件',
    // title
        'title.required'=>'标题不能为空',
        'title.unique'=>'电话已存在',
    // type
        'type.required'=>'类型不能为空'
        ];
    }
}
