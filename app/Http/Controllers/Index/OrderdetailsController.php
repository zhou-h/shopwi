<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class OrderdetailsController extends Controller
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
        // 获取登录用户id
        $userid=session('id');
        $data=DB::table('orders_info')->where('user_id','=',$userid)->get();
        return view('Index.Order_detalis.User_Orderform',['data'=>$data,'type'=>$arr,'goodon'=>$goodon]);
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
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        $res=session('shop_cart');
        // dd($res);
        // $res=$request->all();
        // 获取登录用户id
        $userid=session('id');
        // $userid=2;
        // 判断session里是否有购物车session
        if(!empty(session('shop_cart'))){
        //去除多余字段,获取选中的地址id 
        $addressid=$request->except(['_token','radio','radio1','submit']);
        // 获取指定的地址的数据
        $address=DB::table('address')->where('id','=',$addressid)->first();
        // 获取session数据
        $res=session('shop_cart');
        // dd($res);
        // 定义一个订单详情的数组
        $order_info=[];
        foreach($res as $v){
            // 获取商品表的指定字段数据
            $good=DB::table('goods')->where('id','=',$v['id'])->first();
            // var_dump($good);exit;
            // 补全orders_info表需要的字段
            $order_info[$v['id']]['descr']=$good->descr.$v['color'];
            $order_info[$v['id']]['name']=$good->name;
            $order_info[$v['id']]['price']=$good->price;
            $order_info[$v['id']]['pic']=$good->pic;
            $order_info[$v['id']]['address_id']=$address->id;
            $order_info[$v['id']]['order_num']=date('ymd').rand(1000,9000);
            $order_info[$v['id']]['num']=$v['num'];
            $order_info[$v['id']]['status']=$good->static;
            $order_info[$v['id']]['addtime']=date('Y-m-d H:i:s');
            $order_info[$v['id']]['user_id']=session('id');
            
            // 插入数据到数据库
            // DB::table('orders_info')->insert($order_info);

            //补全
        }
        // 插入数据到数据库
            DB::table('orders_info')->insert($order_info);
        // 删除购物车记录
        $request->session()->pull('shop_cart');
        // 获取数据表的数据
        $data=DB::table('orders_info')->where('user_id','=',$userid)->get();
        // dd($data);
        return view('Index.Order_detalis.User_Orderform',['data'=>$data,'type'=>$arr,'goodon'=>$goodon]);
        }else{
            // dd($goodon);
            // 当没有session时,直接遍历数据表
            $data=DB::table('orders_info')->where('user_id','=',$userid)->get();
            return view('Index.Order_detalis.User_Orderform',['data'=>$data,'type'=>$arr,'goodon'=>$goodon]);
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

    public function detalis(Request $request){
        // echo 1; 
    }

    // 订单状态修改
    public function status($id,$status){
        if(DB::update('update orders_info set status = ? where id = ?',[$status,$id])>0){
            return redirect("/orderuser");
        }else{
            return redirect("/orderuser");
        }
    }

    // 支付方法
    public function paymoney($id){
        // 获取订单id的数据
        $order=DB::table('orders_info')->where('id','=',$id)->first();
        // 把订单id存储在session里
        session(['orderid'=>$id]);
        // 获取订单号
        $order_num=$order->order_num;
        // 获取订单商品名
        $name=$order->name;
        // 获取价格
        $total=$order->price*$order->num;
        // 获取订单商品描述
        $descr=$order->descr;
        // 调用支付接口
        pay($order_num,$name,0.01,$descr);
    }
    // 支付窗口回调
    public function returnpay(Request $request){
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        // 获取订单id
        $orderid=session('orderid');
        $status=2;
        session(['buyok'=>'ok']);
        // dd($orderid);
        if(DB::update('update orders_info set status = ? where id = ?',[$status,$orderid])>0){
            return redirect("/orderuser");
        }else{
            return redirect("/orderuser");
        }
    }
    // 删除订单
    public function del(Request $request){
        // 获取要删除的订单id
        $id=$request->input('id');
        // 
        $orderone=DB::table('orders_info')->where('id','=',$id)->first();
        if($orderone->status==4){
            if(DB::table('orders_info')->where('id','=',$id)->delete()>0){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            echo '3';
        }
        
    }
    // 订单详情
    public function orderinfo($id){
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        // dd($goodon);
        // $id=$request->input('id');
        $address='';
        $orders_info=DB::table('orders_info')->where('id','=',$id)->first();
        $address=DB::table('address')->where('id','=',$orders_info->address_id)->first();
        // dd($address);
        return view('Index.Order_detalis.Orderinfo',['orders_info'=>$orders_info,'address'=>$address,'type'=>$arr,'goodon'=>$goodon]);
    }
}
