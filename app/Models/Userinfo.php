<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    //规定属性 模板关联的数据表
    protected $table = 'user_info';
    // 主键
    protected $primaryKey = 'id';
    // 该模型是否需要自动维护时间戳 false true
    public $timestamps = false;
    // 可以被批量赋值的属性
    protected $fillable = ['user_id','pic','name','email','sex','phone','addtime','uptime'];

    //修改器
    public function getStatusAttribute($value){
		$sex = [1=>'男',0=>'女'];
		return $sex[$value];
	}
}
