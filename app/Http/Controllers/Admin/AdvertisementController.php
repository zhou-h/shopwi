<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入表单验证类
use App\Http\Requests\AdmimAdvertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 加载广告列表页面
        $k=$request->input('keywords');
        //获取列表数据
        $data=DB::table("advertisement")->where("title",'like',"%".$k."%")->paginate(2);
        // 获取数据
        return view('Admin.Advertisement.advertisement',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //广告添加
        return view('Admin.Advertisement.advertisement-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdmimAdvertisement $request)
    {
        // var_dump($request);
        // 判断是否有文件上传
        if ($request->hasFile('content')) {
           //初始化名字
            $name=time()+rand(1,10000);
            // 获取文件后缀
            $ext=$request->file("content")->getClientOriginalExtension();
            //移动到指定的目录下
            $request->file("content")->move("./uploads/Advertisement",$name.".".$ext);
            // echo $content;
            // 文件的路径
            $content = './uploads/Advertisement/'.$name.'.'.$ext;
            // var_dump($content);
        }
        $data = $request->except('_token');
        $data['content'] = $content;
        // var_dump($data);
        // 判断添加是否成功
        if(DB::table("advertisement")->insert($data)){
            return redirect("/advertisement")->with('success','数据添加成功');
        }else{
            return redirect("/advertisement")->with('error','数据添加失败');
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
        // 商品修改
        $data = DB::table('advertisement')->where('id','=',$id)->first();
        return view('Admin.Advertisement.advertisement-edit',['data'=>$data]);
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
        if ($request->hasFile('content')){
            //初始化名字
            $name=time()+rand(1,10000);
            // 获取原文件路径
            $file = DB::table('advertisement')->where('id','=',$id)->first();
            // var_dump($file);
            $path = $file->content;
            // dd($path);
            // 删除原文件
            unlink($path);
            // 获取文件后缀
            $ext=$request->file("content")->getClientOriginalExtension();
            // dd($content);
             //移动到指定的目录下
            $request->file("content")->move("./uploads/Advertisement",$name.'.'.$ext);
            $content = './uploads/Advertisement/'.$name.'.'.$ext;
        }else{
            // 如果没有上传文件，获取原来的图片地址
            $file = DB::table('advertisement')->where('id','=',$id)->first();
            // var_dump($file);
            $content = $file->content;
            // var_dump($content);exit;
        }
        // 获取所有的修改数据
        $data = $request->except('_token','_method');
        $data['content'] = $content;
       // var_dump($data);
       // 判断修改
        if(DB::table("advertisement")->where("id","=",$id)->update($data)){
            return redirect("/advertisement")->with('success',"修改成功");
        }else{
            return back()->with("error",'数据修改失败,请修改数据');
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

    // ajax删除
    public function del(Request $request){
        $id=$request->input('id');
        // 获取原来pic的地址
        $a = DB::table('advertisement')->where("id",'=',$id)->first();
        // var_dump($a);
        $content = $a->content;
        // 删除原来的content
        unlink($content);
        if(DB::table("advertisement")->where("id",'=',$id)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }

    // ajax修改状态
    public function doedit(Request $request){
        $id=$request->input('id');
        $display['display']=$request->input('display');
        // echo $display;
         if(DB::table("advertisement")->where("id",'=',$id)->update($display)){
            echo 1;
        }else{
            echo 0;
        }
    }
}
