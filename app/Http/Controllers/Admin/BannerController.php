<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入表单请求校验类
use App\Http\Requests\AdminBanner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //轮播图列表
        // 获取数据
        $data = DB::table('carouse')->select()->paginate(5);
        return view('Admin.Banner.banner',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 添加轮播图
        return View('Admin.Banner.banner-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBanner $request)
    {
        // var_dump($request);
        // 判断文件是否有上传
        if ($request->hasFile('pic')) {
            // 初始化名字
            $name = time()+rand(1,10000);
            // 获取文件后缀
            $ext = $request->file('pic')->getClientOriginalExtension();
            // 移动文件
            $request->file('pic')->move('./uploads/Banner/',$name.'.'.$ext);
            // 获取文件路径
            $pic = './uploads/Banner/'.$name.'.'.$ext;
            // dd($pic);
        }
        // 处理上传的数据
         $data = $request->except('_token');
        $data['pic'] = $pic;
        // var_dump($data);
        // 判断是否添加成功
        if(DB::table('carouse')->insert($data)){
            return redirect("/banner")->with('success','数据添加成功');
        }else{
             return redirect("/banner")->with('error','数据添加失败');
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
        // 轮播图修改
         $data = DB::table('carouse')->where('id','=',$id)->first();
        return view('Admin.Banner.banner-edit',['data'=>$data]);
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
        // dd($id);
        if ($request->hasFile('pic')){
        // var_dump($id);
        //初始化名字
        $name=time()+rand(1,10000);
        // 获取原文件路径
        $file = DB::table('carouse')->where('id','=',$id)->first();
        // var_dump($file);
        $path = $file->pic;
        // dd($path);
        // 删除原文件
        unlink($path);
        // 获取文件后缀
        $ext=$request->file("pic")->getClientOriginalExtension();
        // dd($logo);
         //移动到指定的目录下
        $request->file("pic")->move("./uploads/Banner",$name.'.'.$ext);
        $pic = './uploads/Banner/'.$name.'.'.$ext;
        }else{
            // 如果没有上传文件，获取原来的图片地址
            $file = DB::table('carouse')->where('id','=',$id)->first();
            // var_dump($file);
            $pic = $file->pic;
            // var_dump($logo);exit;
        }
        // 获取所有的修改数据
        $data = $request->except('_token','_method');
        $data['pic'] = $pic;
       // var_dump($data);
       // 判断修改
        if(DB::table("carouse")->where("id","=",$id)->update($data)){
            return redirect("/banner")->with('success',"修改成功");
        }else{
            return back()->with("error",'数据修改失败，请修改数据');
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

    // Ajax删除
    public function del(Request $request){
        $id=$request->input('id');
        // 获取原来pic的地址
        $a = DB::table('carouse')->where("id",'=',$id)->first();
        // var_dump($a);
        $pic = $a->pic;
        // 删除原来的pic
        unlink($pic);
        if(DB::table("carouse")->where("id",'=',$id)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }

    // Ajax修改
    public function doedit(Request $request){
        $id=$request->input('id');
        $status['status']=$request->input('status');
        // echo $status;
         if(DB::table("carouse")->where("id",'=',$id)->update($status)){
            echo 1;
        }else{
            echo 0;
        }
    }
}
