<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = $request->except("_token");
        $addtime=date("Y-m-d H:i:s");
        $data['addtime']=$addtime;
        $goods_id=$data['goods_id'];
        
        // 判断添加是否成功
        if(DB::table("goods_judge")->insert($data)){
            return redirect("/detail/$goods_id")->with('success','发表成功');
        }else{
            return back()->with('error','发表失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 模拟的用户id和用户名
        session(['id' => '2']);
         session(['username' => 'liu']);
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
        // var_dump($judgelist);exit;
        // 加载模板
        return view('Index.Detailed.Detailed',['judgelist'=>$judgelist,'id'=>$id]);
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
