<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\collect;
use App\Models\Goods;
use App\Models\Type;
class CollectController extends Controller
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

    public function index(Request $request)
    {
        //收藏页
        //遍历商品属性
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        //收藏的总条数
        $sum=collect::where('user_id')->count();
        //获取用户id
        $user_id=session('id');
        //收藏的商品
        $id=collect::where('user_id','=',$user_id)->pluck('goods_id');
        $data=Goods::whereIn('id',$id)->where('static','=','0')->paginate(12);
        // dd($data);
        return view('Index.Collect.User_Collect',['type'=>$arr,'goodon'=>$goodon,'sum'=>$sum,'data'=>$data,'request'=>$request->all()]);

    }
    //加入收藏
    public function getCollect(Request $request){
        $id=$request->all();
        $id['user_id']=session('id');
        // dd($id);
        if(collect::insert($id)){
            echo 1;
        }else{
            echo 0;
        }
    }
    //移除收藏
    public function outCollect(Request $request){
        $id=$request->input('goods_id');
        // dd($id);
        if(collect::where('goods_id','=',$id)->where('user_id','=',session('id'))->delete()){
            echo 1;
        }else{
            echo 0;
        }
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
    public function show($id,Request $request)
    {
        

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
