<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AdminLetter extends FormRequest
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
            //title
            'title'=>'required',
            //content
            'content'=>'required',
            //sender
            'sender'=>'required'
            
        ];
    }

     //自定义错误
   public function messages(){
        return[
            'title.required'=>'标题不能为空',
            // title
            'content.required'=>'内容不能为空',
            // sender
            'sender.required'=>'收件人不能为空',
        ];
    }
}
