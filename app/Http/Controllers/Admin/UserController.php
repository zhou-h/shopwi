<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入模型类
use App\Models\User;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        // 加载会员列表
        // 获取搜索框的信息
        $k = $request->input('keywords');
        // 查数据
        $data = DB::table('user')->where('username','like','%'.$k.'%')->paginate(5);
        // $data = user::where('username','like','%'.$k.'%')->paginate(5);
        // var_dump($data);exit;
        return view('Admin.User.user',['data'=>$data,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 添加会员页面
        return view('Admin.User.add');
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
        // 获取会员详情信息
        $userinfo = User::find($id)->info;
        // 加载会员详情模板
        return view('Admin.User.userinfo',['userinfo'=>$userinfo]);
    }


    public function address($id)
    {
        // 获取会员下面的收货地址
        // echo "11";exit;
        $ress = User::find($id)->address;
        // 加载地址模板
        // dd($ress);
        return view('Admin.User.address',['ress'=>$ress]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 会员修改
        return view('Admin.User.user-edit');
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
    public function destroy(Request $request,$id)
    {
        $u = $request->input('user_id');
        // 删除会员地址
        if(DB::table('address')->where('id','=',$id)->delete()){
            return redirect('/address/'.$u)->with('success','地址删除成功');
        }else{
            return redirect('/address/'.$u)->with('success','地址删除失败');   
        }
    }
    public function del(Request $request)
    {
        // 获取删除的id
        $id = $request->input('id');
        // 执行删除
        if(DB::table('address')->where('id','=',$id)->delete()){
            echo 1;
        }
    }
}
