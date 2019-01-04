<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goodsize extends Model
{
    //laravel 里一个模型类对应一个数据表
    //规定属性:模型关联的数据表
    protected $table='good_size';
    //设置主键
    protected $primarykey='id';
    //该模型是否需要自动维护时间戳 false=>否 true =>是
    public $timestamps=true;
    //可以批量赋值的字段
    protected $fillable=['good_id','color','store'];
}
