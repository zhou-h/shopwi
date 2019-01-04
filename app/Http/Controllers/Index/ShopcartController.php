<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class ShopcartController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        // 获取session数据里的商品数据
        $res=session('shop_cart');
        // var_dump($res);exit;
        // 定义数组存储数据
        $data=[];
        // 定义总计
        $total='';
        if(!empty($res)){
            // 遍历数据
             foreach($res as $k => $v) {
                // 获取单条数据
                $one=DB::table('goods')->where('id','=',$v['id'])->first();
                $row['name']=$one->name;
                // dd($row);
                $row['id']=$v['id'];
                $row['price']=$one->price;
                $row['pic']=$one->pic;
                $row['descr']=$one->descr;
                $row['color']=$v['color'];
                $row['store']=$v['store'];
                $row['num']=$v['num'];
                $row['tot']=$one->price*$v['num'];
                $total+=$row['tot'];
                $data[]=$row;
            }
            // var_dump($total);exit;
            //加载购物车首页
            return view('Index.Shop_cart.shop_cart',['data'=>$data,'total'=>$total,'type'=>$arr,'goodon'=>$goodon]);
        }else{
            return view('Index.Shop_cart.shop_cart',['data'=>$data,'type'=>$arr,'goodon'=>$goodon]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 执行购物车操作
    public function store(Request $request)
    {
        
        
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

    // 去重   去掉重复的加入购物车的物品
    public function check($id){
        // 获取session数据
        $goods=session('shop_cart');
        // 判断session里是否有数据
        if(empty($goods)){
            return false;
        }
        // 遍历
        foreach($goods as $k=>$v){
            // 判断session有没有相同的商品id
            if($id==$v['id']){
                return true;
            }
        }
        
    }

    // 添加数据到session $ids 表示规格id $goodid 商品id
    public function add(Request $request,$ids,$goodid,$nums){
        // 获取good_size表的单条数据
        $goodsize=DB::table('good_size')->where('id','=',$ids)->first();
        // 获取库存
        $store=$goodsize->store;
        // 获取颜色
        $color=$goodsize->color;
        // 赋值
        $data['id']=$goodid;
        $data['num']=$nums;
        $data['store']=$store;
        $data['color']=$color;
        // 调用去重
        if(!$this->check($data['id'])){
            // 将商品数据写入session里
            $request->session()->push('shop_cart',$data);
        }
        
        // 跳转到购物车页面
        return redirect("/shopcart");
    }

    // 增加数量方法
    public function jia($id){
        // 获取session值
        $data=session('shop_cart');
        // dd($data);
        // 遍历
        foreach($data as $k=>$v){
            if($id==$v['id']){
                // 商品数量加一
                $num=$v['num']+1;
                // 将商品减后的商品数量赋值
                $data[$k]['num']=$num;
                // 判断数量的限制
                if($data[$k]['num']>=$v['store']){
                    $data[$k]['num']=$v['store'];
                }
            }
        }
        // dd($data);
        // 重新给session赋值
        session(['shop_cart'=>$data]);
        // 跳转页面
        return redirect('/shopcart/');
    }
    
    // 减少数量方法
    public function jian($id){
        // 获取session值
        $data=session('shop_cart');
        // dd($data);
        // 遍历
        foreach($data as $k=>$v){
            if($id==$v['id']){
                // 商品数量减一
                $num=$v['num']-1;
                // 将商品减后的商品数量赋值
                $data[$k]['num']=$num;
                // 判断数量的限制
                if($data[$k]['num']<=1){
                    $data[$k]['num']=1;
                }
            }
            
        }
        // 重新给session赋值
        session(['shop_cart'=>$data]);
        // 跳转页面
        // return redirect('/shopcart/');

    }

    // 删除单个商品事件
    public function delone(Request $request){
        // 获取要删除的id
        $id=$request->input('id');
        // 获取session
        $data=session('shop_cart');
        foreach($data as $k=>$v){
            if($id==$v['id']){
                unset($data[$k]);
                echo 1;
            }
        }

    }   
}
