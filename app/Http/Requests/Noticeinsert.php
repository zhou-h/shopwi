<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Noticeinsert extends FormRequest
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
            // 公告告标题做规则设置
            'title'=>'required',//标题不能为空
            'content'=>'required',//公告内容不能为空

        ];
    }

    // 自定义错误信息
    public function messages(){
        return[
            'title.required'=>'请输入公告标题',
            'content.required'=>'请输入公告内容',
        ];
    }
}
