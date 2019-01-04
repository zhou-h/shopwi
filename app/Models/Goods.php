<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //laravel 里一个模型类对应一个数据表
    //规定属性:模型关联的数据表
    protected $table='goods';
    //该模型是否需要自动维护时间戳
    public $timestamps=true;
    //可以批量赋值的字段
    protected $fillable=['name','type_id','pic','descr','price','sales','static','recom'];

    //修改器 对获取到的数据进行处理 
    public function getStaticAttribute($value){
        //处理字段状态
        $static=[0=>'显示',1=>'隐藏'];
        // 处理返回后的数据
        return $static[$value];
   }
   //修改器 对获取到的数据进行处理 
    public function getRecomAttribute($value){
        //处理字段状态
        $recom=[3=>'不推荐',2=>'推荐'];
        // 处理返回后的数据
        return $recom[$value];
   }
   
    public function info(){
        //一对一的关系 hasOne(关联的模型类,关联字段);
        return $this->hasOne('App\Models\Type','type_id');
    }

    public function goodsize(){
        //一对多的关系 hasMany(关联的模型类,关联字段);
        return $this->hasMany('App\Models\Goodsize','good_id');
    }
}
