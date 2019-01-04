<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Goodsize;
use App\Models\Type;
// 引入校验类
use App\Http\Requests\AdminGoodinsert;
use App\Http\Requests\AdminGoodedit;
use App\Http\Requests\AdminGoodsize;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //搜素 获取keyword
        $k=$request->input('keywords');
        //模糊搜索+分页
        $goods=Goods::where('name','like','%'.$k.'%')->paginate(4);
        foreach($goods as $value){
            // var_dump($value->type_id);
            //通过搜索type_id 得到type_name
            $tname=Type::where('id','=',$value->type_id)->value('name');
            // var_dump($tname);
            //再 把得到的name给type_id
            $value->type_id=$tname;
            // var_dump($value->type_id);
            
            //总库存stocks
            //获取同一商品里面的所有数据
            $num=Goodsize::where('good_id','=',$value->id)->get();
            foreach($num as $v){
                //把所有规格的库存相加起来等于总库存 stocks存入商品对象中
                $value->stocks += $v->store;
            }
            //如果商品没有库存 则显示为0
            if(!$value->stocks){
                $value->stocks = '没有库存';
            }
        }
        // dd($goods);
        // exit;
        // 加载商品列表页面
        return view('Admin.Goods.goodss',['goods'=>$goods,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //商品添加
        //DB::raw() 插入原生的sql语句 防止sql注入
        $type=Type::select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        //加分隔符
        foreach($type as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数
            $type[$key]->name=str_repeat("--/",$len).$value->name;
        }
        return view('Admin.Goods.goodss-add',['type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminGoodinsert $request)
    {
        $data=$request->except('_token'); 
        // dd($data);       
        //检测是否有文件上传
        if($request->hasFile('pic')){
            //获取typeid
            // $tid=$request->input('type_id');
            //通过tid获取type name
            // $tname=Type::where('id','=',$tid)->value('name');
            //初始化文件名字
            $name=time()+rand(1000,99999);
            //获取上传文件后缀
            $ext=$request->file('pic')->getClientOriginalExtension();
            //放置图片的文件夹地址
            $path='./uploads/'.date('Y-m-d').'--goods';
            //修改图片名
            $data['pic']=trim($path.'/'.$name.'.'.$ext,'.');
            //把长传文件移动到指定目录下
            $request->file('pic')->move($path,$data['pic']);
        }
        // dd($data);
        if(Goods::create($data)){
            return redirect("/goods")->with('success','数据添加成功');
        }else{
            return redirect("/goods/create")->with('error','数据添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $k=$request->input('keyword');
        //规格详情展示
        $info=Goods::find($id)->goodsize;
        //商品属性
        $good=Goods::where('id','=',$id)->first();
        // dd($good->name);
        return view('Admin.Goods.goodss-size',['info'=>$info,'good'=>$good]);
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
        $good=Goods::where('id','=',$id)->first();
        // dd($good->type_id);
        $selected='';
        //DB::raw() 插入原生的sql语句 防止sql注入
        $type=Type::select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        //加分隔符
        foreach($type as $key=>$value){
            // echo $value->path."<br>";
            //把path字符串转换为数组
            $arr=explode(",",$value->path);
            // dd($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //重复字符串函数
            $type[$key]->name=str_repeat("--/",$len).$value->name;
        }
        return view('Admin.Goods.goodss-edit',['type'=>$type,'good'=>$good,'type_id'=>$good->type_id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminGoodedit $request, $id)
    {
        //执行修改
        $data=$request->except('_token','_method');
        //获取当前ID的数据
        $info=Goods::where('id','=',$id)->first();
        // dd($m);
        if($request->hasFile('pic')){
            //如果有要上传的图片 那么将删除原来的图片
            $m='.'.$info->pic;
            //删除隐藏域
            unset($data['oldpic']);
            //初始化文件名字
            $name=time()+rand(1000,99999);
            //获取上传文件后缀
            $ext=$request->file('pic')->getClientOriginalExtension();
            //放置图片的文件夹地址
            $path='./uploads/'.date('Y-m-d').'--goods';
            //修改图片名
            $data['pic']=trim($path.'/'.$name.'.'.$ext,'.');
            //把长传文件移动到指定目录下
            $request->file('pic')->move($path,$data['pic']);
            if(Goods::where('id','=',$id)->update($data)){
                unlink($m);
                return redirect("/goods")->with('success','数据修改成功');
            }else{
                return redirect("/goods/create")->with('error','数据修改失败');
            }
        }else{
            $data['pic']=$data['oldpic'];
            unset($data['oldpic']);
            // dd($data);
            if(Goods::where('id','=',$id)->update($data)){
                return redirect("/goods")->with('success','数据修改成功');
            }else{
                return redirect("/goods/create")->with('error','数据修改失败');
            }
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
        //商品删除
        
    }

    //ajax修改状态static属性
    public function goodsedit(Request $request){
        $arr=$request->all();
        // dd($arr);
        if(Goods::where('id','=',$arr['id'])->update($arr)){
            echo 666;
        }else{
            echo 0;
        } 
    }
    //ajax修改状态recom属性
    public function goodsedits(Request $request){
        $arr=$request->all();
        // dd($arr);
        if(Goods::where('id','=',$arr['id'])->update($arr)){
            echo 666;
        }else{
            echo 0;
        } 
    }

    //ajax删除
    public function goodsdel(Request $request){
        $id=$request->input('id');
        $info=Goods::where('id','=',$id)->first();
        if(Goods::where('id','=',$id)->delete($id)){
            //执行删除商品中的规格
            $size=Goodsize::where('good_id','=',$id)->delete($id);
            //执行删除旧图片
            $m='.'.$info->pic;
            unlink($m);
            echo 666;
        }else{
            echo 0;
        } 
    }

    //商品规格添加
    public function sizeadd(Request $request,$id){
        return view('Admin.Goods.sizess-add',['id'=>$id]);
    }
    //执行商品添加
    public function sizedoadd(AdminGoodsize $request){
        //获取传递过来的数据
        $data=$request->except('_token');
        // dd($data);
        //执行添加
        if(Goodsize::create($data)){
            return redirect("/goods/".$data['good_id'])->with('success','数据添加成功');
        }else{
            return redirect("/sizeadd/".$data['good_id'])->with('error','数据添加失败');
        }
    }

    //执行规格删除
    public function sizedel(Request $request){
        $id=$request->input('id');
        if(Goodsize::where('id','=',$id)->delete($id)){
            echo 666;
        }else{
            echo 0;
        } 
    }

    //执行修改
    public function sizeedit(Request $request,$id){
        $data=Goodsize::where('id','=',$id)->first();
        // dd($data);
        return view('Admin.Goods.sizess-edit',['data'=>$data]);
    }

    public function sizedoedit(AdminGoodsize $request){
        $data=$request->except('_token');
        // dd($data);
        if(Goodsize::where('id','=',$data['id'])->update($data)){
            return redirect("/goods/".$data['good_id'])->with('success','数据修改成功');
        }else{
            return redirect("/sizeedit/".$data['good_id'])->with('error','数据修改失败');
        }

    }
}
