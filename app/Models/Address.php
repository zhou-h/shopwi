<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //规定属性 模型关联的数据表
    protected $table ='address';
    // 主键
    protected $primaryKey = 'id';
    // 该模型是否需要自动维护时间戳 
    public $timestamps  = false;
    // 可被批量赋值的属性
    protected $fillable  = ['address','user_id','addtime','name','email','pc','phone','t_phone'];
}
