<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入DB;
use DB;
// 导入模型类
use App\Models\Notice;
//  导入校验类
use App\Http\Requests\Noticeinsert;
class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取搜索关键词    
        $k=$request->input('keywords');
        //获取列表数据        
        $data = notice::where('title','like','%'.$k.'%')->paginate(5);
        //加载模板  
        return view("Admin.Notice.notice",['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载添加模板
        return view('Admin.Notice.notice-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Noticeinsert $request)
    {
        // 执行添加
        $data = $request->except('_token','_method');
        // dd($data);
        if(DB::table('notice')->insert($data)){
            return redirect('/notice')->with('success','
                公告添加成功');
        }else{
            return redirect('/notice/create')->with('error','公告添加失败');
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
        // 修改公告模板
        $data = DB::table('notice')->where('id','=',$id)->first();
        return view('Admin.Notice.notice-edit',['data'=>$data]);
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
        //获取需要修改的数据
        $info = DB::table('notice')->where('id','=',$id)->first();
        // 图片路径
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->content, $arr);
        // dd($arr);
        // 获取修改的内容
        $data = $request->except('_token','_method');
        // dd($data);
        // 执行修改
        if(DB::table('notice')->where('id','=',$id)->update($data)){
            if(isset(($arr[1]))){
                // 遍历图片路径
                foreach($arr[1] as $key=>$v){
                    // 删除图片
                    unlink(".".$v);
                }
            }
            return redirect('/notice')->with('success','修改成功');
        }else{
            return redirect('/notice')->with('error','修改失败');
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
        // 获取删除数据
        $info = DB::table('notice')->where('id','=',$id)->first();
        // 获取图片
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$info->content, $arr);
        // dd($arr);
        if(DB::table('notice')->where('id','=',$id)->delete()){
            // 判断
            if(isset($arr[1])){
                // 删除百度编辑器上传图片
                foreach($arr[1] as $key=>$v){
                    $s = substr($v, -3);
                    $dd=array('jpg','png','jpge');
                    if(in_array($s,$dd)){
                        unlink('.'.$v);
                    }
                }
                return redirect('/notice')->with('success','公告删除成功');
            }else{
            return redirect('/notice')->with('error','公告删除失败');
        }
            
        }
    }
    public function del(Request $request)
    {
        // 获取id
        $id  = $request->input('id');
        // 执行删除
        if(DB::table('notice')->where('id','=',$id)->delete()){
            echo 1;
        }
    }

    // 批量删除
    public function pdel(Request $request){
        $a = $request->input('d');
        if($a==''){
            echo '请至少选中一条数据';exit;
        }
        // 遍历
        foreach($a as $v){
            DB::table('notice')->where('id','=',$v)->delete();
        }
        echo 1;
    }

    // 改变状态
    public function status(Request $request){
        //公告id
        $id = $request->id;
        // 当前状态
        $sta = $request->sta;
        if($sta==1){
            // echo '0';
            $info['status']=0;
           $ds =  DB::table('notice')->where('id','=',$id)->update($info);
        }elseif($sta==0){
            // echo '1';
            $info['status']=1;
            // echo $info;
            DB::table('notice')->where('id','=',$id)->update($info);
        }

    }
}
