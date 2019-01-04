<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
use App\Models\Goodsize;
use App\Models\collect;
class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //菜单遍历
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
        //商品详情页
        //菜单遍历
        $arr=$this->getTypecode(0);
        // 获取商品详情
        $goods=Goods::where('id','=',$id)->first();
        // dd($goods);
        //商品规格
        $goodsize=Goodsize::where('good_id','=',$id)->get();
        //获取同类商品
        $tgood=Goods::where('type_id','=',$goods->type_id)->where('id','!=',$id)->where('static','=','0')->paginate(3);
        //获取商品属性
        $types=Type::where('id','=',$goods->type_id)->first();
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        //是否收藏
        $collect=collect::where('goods_id','=',$id)->first();
        // dd($collect);
        
        
        // 评论
        // 获取用户id
        $user_id = session('id');
        // echo $user_id;exit;
        // 获取数据
        // 所有评价
        $judgeall = DB::select("select username,judge,pic,gj.addtime from user,goods_judge as gj,user_info where user.id=gj.user_id and gj.goods_id={$id} and user.id=user_info.user_id");
        // 所有好评
        $judgegood = DB::select("select username,judge,pic,gj.addtime from user,goods_judge as gj,user_info where user.id=gj.user_id and gj.goods_id={$id} and gj.status=2 and user.id=user_info.user_id");
        // 所有一般评价
        $judgeordinary = DB::select("select username,judge,pic,gj.addtime from user,goods_judge as gj,user_info where user.id=gj.user_id and gj.goods_id={$id} and gj.status=1 and user.id=user_info.user_id");
        // 所有差评
        $judgebad = DB::select("select username,judge,pic,gj.addtime from user,goods_judge as gj,user_info where user.id=gj.user_id and gj.goods_id={$id} and gj.status=0 and user.id=user_info.user_id");
        // var_dump($judgebad);exit;
        $judgelist['judgeall']=$judgeall;
        $judgelist['judgegood']=$judgegood;
        $judgelist['judgeordinary']=$judgeordinary;
        $judgelist['judgebad']=$judgebad;
        return view('Index.Detailed.Detailed',['type'=>$arr,'goods'=>$goods,'id'=>$id,'goodsize'=>$goodsize,'tgood'=>$tgood,'types'=>$types,'goodon'=>$goodon,'collect'=>$collect,'judgelist'=>$judgelist]);
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

    public function getDetail(Request $request){
        $ids=$request->input('id');
        $size=Goodsize::where('id','=',$ids)->first();
        echo json_encode($size);
    }

}
