<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class collect extends Model
{
    //laravel 里一个模型类对应一个数据表
    //规定属性:模型关联的数据表
    protected $table='collect';
    //该模型是否需要自动维护时间戳
    public $timestamps=false;
    //可以批量赋值的字段
    protected $fillable=['id','goods_id','user_id'];
}
