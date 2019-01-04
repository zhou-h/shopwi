<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入表单验证类
use App\Http\Requests\IndexLink;
// 导入模型类
use App\Models\Goods;
use App\Models\Type;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //无限分类
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

    public function index()
    {
        //遍历商品属性
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);

        // 显示页面
        // echo '友情链接';
        // 获取数据
        $data0 = DB::table('friendly_link')->where('type','=','0')->where('status','=','1')->get();
        // var_dump($data0);
        $data1 = DB::table('friendly_link')->where('type','=','1')->where('status','=','1')->get();
        $data2 = DB::table('friendly_link')->where('type','=','2')->where('status','=','1')->get();
        $data3 = DB::table('friendly_link')->where('type','=','3')->where('status','=','1')->get();
        $data4 = DB::table('friendly_link')->where('type','=','4')->where('status','=','1')->get();
        $data5 = DB::table('friendly_link')->where('type','=','5')->where('status','=','1')->get();
        return view('Index.Link.link',['data0'=>$data0,'data1'=>$data1,'data2'=>$data2,'data3'=>$data3,'data4'=>$data4,'data5'=>$data5,'type'=>$arr,'goodon'=>$goodon]);
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
    public function store(IndexLink $request)
    {
        // var_dump($request->all());exit;
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
        $data['status'] = 0;
        // 判断添加是否成功
        if(DB::table("friendly_link")->insert($data)){
            return redirect("/indexlink")->with('success','数据添加成功');
        }else{
            unlink($logo);
            return back()->with('no','数据添加失败,请重新填写');
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

    // ajax判断手机号码
    public function phone(Request $request){
        $phone = $request->input('phone');
        // echo $phone;
        // 获取数据库的所有电话
        $p =DB::table('friendly_link')->pluck('phone');
        $arr = array();
        // 将获取的对象转换为数组
        foreach ($p as $key => $value) {
            $arr[$key] = $value;
        }
        // 对比电话号码，判断是否存在
        if (in_array($phone, $arr)) {
            echo 1; //手机号已经存在
        }else{
            echo 0; //手机号不存在，可以使用
        }
    }
}
