<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // 获取搜索关键字
        $k=$request->input('key');

        //遍历表
        $order=DB::table('orders_info')->where('id','like','%'.$k.'%')->paginate(3);
        // dd($order);
        // 模型
        // $order=Order::where('id','like','%'.$k.'%')->paginate(3);
        // 加载订单列表页面
        return view('Admin.Order.orders',['order'=>$order,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 订单添加
        return view('Admin.Order.order-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        // 删除多余的字段
        $data=$request->except(['_token']);
        if(DB::table('orders_info')->insert($data)){
            return redirect("/order")->with("success","添加成功");
        }else{
            return redirect("/order")->with("success","添加失败");
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
        // 订单修改
        return view('Admin.Order.order-edit');
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
        if(DB::table('orders_info')->where('id','=',$id)->delete()){
            return redirect("/order")->with('success','删除成功');
        }else{
            return redirect("/order")->with('error','删除失败');
        }
    }

    // 修改订单状态
    public function status($id,$status){
        if(DB::update('update orders_info set status = ? where id = ?',[$status,$id])>0){
            return redirect("/order")->with('success','修改成功');
        }else{
            return redirect("/order")->with('error','修改失败');
        }
    }
}
