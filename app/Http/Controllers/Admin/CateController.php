<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Type;
// 引入校验类
use App\Http\Requests\AdminTypeinsert;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // return view('Admin.Cate.cate');exit;
        //$name 获取请求报文中提交的参数keyword
        $name=$request->input('keyword');
        //模糊搜索$name 获取它的id
        if($name){
            // $id=Type::select('id')->where('name','like','%'.$name.'%');
            $id=DB::table('type')->where('name','like','%'.$name.'%')->value('id');
        }else{
            $id='';
        }
        // var_dump($id);
        // dd($id);
       //转换为连贯方法
       //DB::raw() 插入原生的sql语句 防止sql注入
        $cate=Type::select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->where('name','like',"%".$name."%")->orWhere('path','like','%,'.$id.'%')->paginate(12);
        //加分隔符
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数 
            $cate[$key]->name=str_repeat("--/",$len).$value->name;
        }
        // dd($cate);
        // 加载分类列表 $request->all();获取所有提交的参数
        return view('Admin.Cate.cates',['cate'=>$cate,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate=Type::select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        //加分隔符
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数
            $cate[$key]->name=str_repeat("--/",$len).$value->name;
        }
        // dd($cate);
        // 分类添加页面
        return view('Admin.Cate.cates-add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminTypeinsert $request)
    {
        //获取提交过来的信息
        $data=$request->except('_token');
        $pid=$request['pid'];
        // dd($pid);
        //判断
        if($pid==0){
            //添加的是顶级分类
            //拼接path
            $data['path']='0';
        }else{
            //添加的是子类
            //拼接path  父类 path.父类的id
            //获取父类的信息
            $info=DB::table("type")->where("id",'=',$pid)->first();
            $data['path']=$info->path.",".$info->id;

        }
        // dd($data);
        if(Type::create($data)){
            return redirect("/cate")->with('success','数据添加成功');
        }else{
            return redirect("/cate/create")->with('error','数据添加失败');
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
        // dd($id);
        $data=Type::where('pid','=',$id)->get();
        dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取当前数据
        $cate=Type::where('id','=',$id)->first();
        //获取所有数据
        $data=Type::get();
        foreach($data as $key=>$row){
            if($row->id==$cate->pid){
                // echo $key;
                // var_dump($row->name);
                unset($data[$key]);
            }
            if($row->id==$id){
                unset($data[$key]);
            }
        }
        // dd($data);
        if($cate->pid){
            $class=Type::where('id','=',$cate->pid)->value('name');
            // dd($class);
        }else{
            $class='--请选择--';
        }
        // dd($data);
        // 分类修改
        return view('Admin.Cate.cates-edit',['cate'=>$cate,'data'=>$data,'class'=>$class,'pid'=>$cate->pid]);
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
        $data=$request->except(['_token','_method']);
        //查看pid  是否有子类 
        $raw=DB::table('type')->where('pid','=',$id)->count();
        // dd($raw);
        if($raw){
            return redirect('/cate')->with('error','修改失败!请先该类有子类');
        }

        if($data['pid']==0){
            $data['path']=0;
        }else{
            $p=Type::where('id','=',$data['pid'])->first();
            // dd($p);
            $data['path']=$p->path.','.$p->id;
        }
        // dd($data);
        //执行修改
        if(Type::where("id",'=',$id)->update($data)){
            return redirect("/cate")->with("success","修改成功");
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
        //查看good_id  是否有商品 还有商品就不能删除 
        $shop=DB::table('goods')->where('type_id','=',$id)->count();
        //查看pid  是否有父类 
        $raw=DB::table('type')->where('pid','=',$id)->count();
        // dd($raw);
        if(!$raw && !$shop){
            if(DB::table('type')->where('id','=',$id)->delete()){
                return redirect('/cates')->with('success','删除成功!');
            }
        }else{
            return redirect('/cate')->with('error','删除失败!请先删除子类');
        }
    }

    //ajax修改状态
    public function cateedit(Request $request){
        $arr=$request->all();
        // var_dump($arr);
        if(type::where('id','=',$arr['id'])->update($arr)){
            echo 666;
        }else{
            echo 0;
        }
        
    }
}
