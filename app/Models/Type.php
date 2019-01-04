<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //laravel里一个模型类对应一个数据表
    //规定属性:模型关联的数据表
    protected $table='type';
    //该模型是否需要自动维护时间戳 false=>否 true =>是
    public $timestamps=true;
    //可以批量赋值的字段
    protected $fillable=['name','pid','path','display','created_at','updated_at'];

    //修改器 对获取到的数据进行处理 
   public function getDisplayAttribute($value){
        //处理字段状态
        $display=[0=>'显示',1=>'隐藏'];
        // 处理返回后的数据
        return $display[$value];
   }

   public function goodbrand(){
        //一对多的关系 hasMany(关联的模型类,关联字段);
        return $this->hasMany('App\Models\Brand','type_id');
    }
}
