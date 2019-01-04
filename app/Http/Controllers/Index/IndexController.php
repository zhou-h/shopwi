<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入DB类
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //无限分类
    public function getTypecode($pid){
        $info = Type::where('pid','=',$pid)->where('display','=','0')->paginate(8);
        // dd($info[0]->id);
        $data=[];
        foreach($info as $v){
            $v->dev=$this->getTypecode($v->id);
            $data[]=$v;
        }
        return $data;
    }
    //获取当前typeid 的 商品 以及子类的商品
    public function bong($id){
        $tt=Type::where('pid','=',$id)->orWhere('id','=',$id)->pluck('id');
        $data=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->whereIn('goods.type_id',$tt)->paginate(8);
        return $data;
    }
    //获取当前属性名字
    public function typename($id){
        $yy=Type::where('pid','=',$id)->orWhere('id','=',$id)->pluck('name');
        //dd($yy);
        return $yy;
    }

    public function index()
    {

        //前台首页
        //遍历商品属性
        $arr=$this->getTypecode(0);
        // dd($arr);
        //遍历商品(推荐的不能少于4个 不然会垮)
        //推荐商品
        $goods=Goods::where('static','=','0')->where('recom','=','2')->paginate(8);
        //热销产品
        $goodtop=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(8);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        //分类及子分类 对应商品遍历
        //1F
        $data=$this->bong(6);
        $daa=$this->typename(6);
        //2F
        $data2=$this->bong(3);
        $daa2=$this->typename(3);
        //3F
        $data3=$this->bong(15);
        $daa3=$this->typename(15);

        // 获取广告的数据
        $advertisement = DB::table('advertisement')->where('display','=',1)->first();
        // 获取轮播图样式
        $carouse = DB::table('carouse')->where('status','=',1)->get();
        // var_dump($carouse);
        // var_dump($advertisement);
        // 获取公告
        $notice = DB::table('notice')->get();
        // var_dump($notice);exit;
        // 加载前台模板 
        return view('Index.Index.index',['type'=>$arr,'goods'=>$goods,'goodtop'=>$goodtop,'data'=>$data,'daa'=>$daa,'data2'=>$data2,'daa2'=>$daa2,'data3'=>$data3,'daa3'=>$daa3,'goodon'=>$goodon,'advertisement'=>$advertisement,'carouse'=>$carouse,'notice'=>$notice]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
