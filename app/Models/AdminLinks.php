<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLinks extends Model
{
    //定义与模型关联的数据表
    protected $table="friendly_link";
    //主键
    protected $primaryKey="id";
    //设置是否需要自动维护时间戳 created_at updated_at
    public $timestamps =true;
     // 可以被批量赋值的属性。
    protected $fillable = ['name','title','logo','phone','url'];
    //修改器的方法
    //对完成的数据(状态 status)做自动处理
    public function getTypeAttribute($value){
        $type=[0=>'游戏类',1=>'生活类',2=>'文学类',3=>'新闻类',4=>'体育类',5=>'其他类'];
        return $type[$value];
    }
}
