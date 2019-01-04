<?php
 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmimAdvertisement extends FormRequest
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
            //url
            'url'=>'required|url',
             //name
            'name'=>'required',
            //title
            'title'=>'required',
            //display
            'display'=>'required',
            //content
            'content'=>'required'
        ];
    }

    //自定义错误
   public function messages(){
        return[
    // url
        'url.required'=>'url不能为空',
        'url.url'=>'url格式不对',
    // name
        'name.required'=>'联系人不能为空',
    // content
        'content.required'=>'内容不能为空',
    // display
        'display.required'=>'状态不能为空',
    // title
        'title.required'=>'标题不能为空'
        ];
    }
}
