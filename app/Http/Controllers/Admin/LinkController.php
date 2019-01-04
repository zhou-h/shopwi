<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入表单请求校验类
use App\Http\Requests\AdminLink;
// 导入模型类
use App\Models\AdminLinks;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // 友情链接列表
         //获取搜索关键词
        $k=$request->input('keywords');
        //获取列表数据
        // $data=DB::table("friendly_link")->where("title",'like',"%".$k."%")->paginate(5);
        // var_dump($data);
        // 加载模板
        $data = AdminLinks::where("title",'like',"%".$k."%")->paginate(5);
        return view('Admin.Link.link',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 友情链接添加
        return view('Admin.Link.link-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminLink $request)
    {
        // echo 1;
        // 判断是否有文件上传
        if ($request->hasFile('logo')) {
           //初始化名字
            $name=time()+rand(1,10000);
            // 获取文件后缀
            $ext=$request->file("logo")->getClientOriginalExtension();
            //移动到指定的目录下
            $request->file("logo")->move("./uploads/Link",$name.".".$ext);
            // echo $logo;
            // 文件的路径
            $logo = './uploads/Link/'.$name.'.'.$ext;
            // var_dump($logo);
        }
        $data = $request->except('_token');
        $data['logo'] = $logo;
        // var_dump($data);
        // 判断添加是否成功
        if(DB::table("friendly_link")->insert($data)){
            return redirect("/link")->with('success','数据添加成功');
        }else{
            return redirect("/link")->with('error','数据添加失败');
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
        // 友情连接修改
        // var_dump($id);exit;
        $data = DB::table('friendly_link')->where('id','=',$id)->first();
        // var_dump($data);
        return view('Admin.Link.link-edit',['data'=>$data]);
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
        if ($request->hasFile('logo')){
        // var_dump($id);
        //初始化名字
        $name=time()+rand(1,10000);
        // 获取原文件路径
        $file = DB::table('friendly_link')->where('id','=',$id)->first();
        // var_dump($file);
        $path = $file->logo;
        // dd($path);
        // 删除原文件
        unlink($path);
        // 获取文件后缀
        $ext=$request->file("logo")->getClientOriginalExtension();
        // dd($logo);
         //移动到指定的目录下
        $request->file("logo")->move("./uploads/Link",$name.'.'.$ext);
        $logo = './uploads/Link/'.$name.'.'.$ext;
        }else{
            // 如果没有上传文件，获取原来的图片地址
            $file = DB::table('friendly_link')->where('id','=',$id)->first();
            // var_dump($file);
            $logo = $file->logo;
            // var_dump($logo);exit;
        }
        // 获取所有的修改数据
        $data = $request->except('_token','_method');
        $data['logo'] = $logo;
       // var_dump($data);
       // 判断修改
        if(DB::table("friendly_link")->where("id","=",$id)->update($data)){
            return redirect("/link")->with('success',"修改成功");
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
        // 获取原来logo的地址
        $a = DB::table('friendly_link')->where("id",'=',$id)->first();
        // var_dump($a);
        $logo = $a->logo;
        // 删除原来的logo
        unlink($logo);
        if(DB::table("friendly_link")->where("id",'=',$id)->delete()){
            echo 1;
        }else{
            echo 0;
        } 
    }
     
    // ajax修改状态
    public function doedit(Request $request){
        $id=$request->input('id');
        $status['status']=$request->input('status');
        // echo $display;
         if(DB::table("friendly_link")->where("id",'=',$id)->update($status)){
            echo 1;
        }else{
            echo 0;
        }
    }
}
