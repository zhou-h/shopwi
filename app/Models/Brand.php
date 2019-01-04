<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //laravel 里一个模型类对应一个数据表
    //规定属性:模型关联的数据表
    protected $table='good_brand';
    //该模型是否需要自动维护时间戳
    public $timestamps=true;
    //可以批量赋值的字段
    protected $fillable=['name','type_id','type_id','logo','static'];

    //修改器 对获取到的数据进行处理 
    public function getStaticAttribute($value){
        //处理字段状态
        $static=[0=>'显示',1=>'隐藏'];
        // 处理返回后的数据
        return $static[$value];
   }
   

    public function goods(){
        //一对多的关系 hasMany(关联的模型类,关联字段);
        return $this->hasMany('App\Models\Goods','good_id');
    }

    public function Type(){
        //一对多的关系 hasMany(关联的模型类,关联字段);
        return $this->hasMany('App\Models\Type','type_id');
    }
}
