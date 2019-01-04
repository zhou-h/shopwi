<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo "111";exit;
        return view('Admin.Index.index');
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
        $data = DB::table('admin_user')->where('id','=',$id)->first();
        return view('Admin.Login.admins-edit',['data'=>$data]);
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
        //获取输入的原密码
        $oldpassword = $request->input('oldpassword');
        // 新密码
        $newpassword = $request->input('password');
        // 把新密码加密入数组
        $data['password']=Hash::make($newpassword);
        // dd($data);
        // 查数据
        $info = DB::table('admin_user')->where('id','=',$id)->first();
        // 判断输入的原密码是否正确
        if(!Hash::check($oldpassword,$info->password)){
            return redirect('/admin123/{$id}/edit')->with('error','原密码不正确');
        }else{
            DB::table('admin_user')->where('id','=',$id)->update($data);
            return redirect('/admin123')->with('success','修改成功');
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
        //
    }
}
