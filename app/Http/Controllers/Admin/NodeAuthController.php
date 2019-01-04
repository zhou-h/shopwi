<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class NodeAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索框数据
        $k = $request->input('keywords');
        $data = DB::table('node')->where('name','like','%'.$k.'%')->paginate(10);
        //加载权限列表
        return view('Admin.Admins.Auth.auth',['auth'=>$data,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模板
        return view('Admin.Admins.Auth.auth-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取添加信息
        $data = $request->except('_token');
        // 执行添加
        if(DB::table('node')->insert($data)){
            return redirect('/nodeauth')->with('success','权限添加成功');
        }
    }
    // 修改权限状态
    public function status(Request $request){
        // 获取状态
        $sta = $request->sta;
        // 获取id
        $id = $request->id;
        if($sta==1){
            // 修改为启用
            $info['status']=0;
            DB::table('node')->where('id','=',$id)->update($info);
        }
        if($sta==0){
            // 修改为启用
            $info['status']=1;
            DB::table('node')->where('id','=',$id)->update($info);
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
        $data = DB::table('node')->where('id','=',$id)->first();
        return view('Admin.Admins.Auth.auth-edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        // 获取提交的信息
        $data = $request->except('_token','_method');
        if(DB::table('node')->where('id','=',$id)->update($data)){
            return redirect('/nodeauth')->with('success','修改成功');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //执行删除node表
        if(DB::table('node')->where('id','=',$id)->delete()){
            DB::table('role_node')->where('nid','=',$id)->delete();
            return redirect('/nodeauth')->with('success','删除成功');
        }
    }
}
