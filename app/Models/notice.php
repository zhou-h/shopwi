<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // 规定属性 模型关联数据表
    protected $table = "notice";
    // 主键
    protected $primaryKey = "id";
    // 该模型是否需要自动维护时间戳 false 否 true 是
    public $timestamps = false;
    //可以被大量赋值的字段
    protected $fillable = ['title','content','status'];
    // 修改器方法
    // 对完成的数据status 状态做自动处理
    public function getStatusAttribute($value){
    	$status = [1=>'禁用','0'=>'激活'];
    	return $status[$value];
    }
}
