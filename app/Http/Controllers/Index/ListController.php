<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
use App\Models\collect;
class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function bong($id,$order){
        $tt=Type::where('pid','=',$id)->orWhere('id','=',$id)->pluck('id');
        if($order!='order'){
            $data=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->whereIn('goods.type_id',$tt)->where('static','=','0')->orderBy($order,'DESC')->paginate(12);
        }else{
            $data=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->whereIn('goods.type_id',$tt)->where('static','=','0')->paginate(12);
        }
        return $data;
    }

    //获取当前属性名字
    public function typename($id){
        $yy=Type::where('id','=',$id)->pluck('name');
        //dd($yy);
        return $yy;
    }


    public function getfunc($typeid,$order,Request $request){
        //商品列表页
        
        //关键字搜索
        $keywords=$request->input('keywords');
        //综合排序
        if($typeid=='all'){
            if($order!='order'){
                $goodz=Goods::where('static','=','0')->orderBy($order,'DESC')->paginate(12);
                $goodz=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->where('static','=','0')->orderBy($order,'DESC')->paginate(12);
                $typename='全部';
            }else{
                //关键字搜索
                if($keywords){
                    $goodz=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->where('static','=','0')->where('goods.name','like','%'.$keywords.'%')->paginate(12);
                        $typename='全部';
                }else{
                    $goodz=DB::table("goods")->join('type','goods.type_id','=','type.id')->select(DB::raw('goods.name as gname,goods.id as gid,goods.pic,goods.price,goods.sales,type.name as tname,type.id as tid'))->where('static','=','0')->paginate(12);
                        $typename='全部';
                }
            }
        }else{
            $goodz=$this->bong($typeid,$order);
            // dd($goodz);
            $typename=$this->typename($typeid);
            // dd($typename);
        }
        //遍历商品属性
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        //推荐商品
        $goods=Goods::where('static','=','0')->where('recom','=','2')->paginate(8);
        //热销产品
        $goodtop=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(8);
        $i=1;
        //是否收藏
        foreach($goodz as $v){
            $v->collect=collect::where('goods_id','=',$v->gid)->first();
        }

        // dd($keywords);

        return view('Index.List.list',['type'=>$arr,'goodon'=>$goodon,'goods'=>$goods,'goodz'=>$goodz,'request'=>$request->all(),'goodtop'=>$goodtop,'i'=>$i,'typename'=>$typename,'typeid'=>$typeid]);
    }

    public function index(Request $request)
    {

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
