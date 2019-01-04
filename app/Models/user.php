<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   // 与模型关联的数据表
	protected $table = 'user';
	// 改模型是否被自动维护的时间戳
	public $timestamps = false;
	//可以被批量赋值的属性
	protected $fillable = ['username','password','status','addtime','uptime'];
	// 修改器方法
	// 对完成的数据status 状态做自动处理
	public function getStatusAttribute($value){
		$status = [1=>'禁用',0=>'启用'];
		return $status[$value];
	}

	// 会员模型与详情模型关联
	public function info(){
		// hasOne　一对一　user_id 两个模型关联的字段
		return $this->hasOne('App\Models\Userinfo','user_id');
	}

	// 获取会员下面的所有地址 
	public function address(){
		// hasMany 一对多
		return $this->hasMany('App\Models\Address','user_id');
	}
}
