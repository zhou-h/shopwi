<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDO;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class OrderController extends Controller
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

        if(!empty(session('shop_cart'))){
            // 获取session数据里的商品数据
            $res=session('shop_cart');
            // 测试
        }
        // 获取登录账号的id
            $id=session('id');
            // var_dump($id);exit;
        // 定义数组存储数据
        $data=[];
        // 定义总计
        $total='';
        // 获取该登录用户所有的收货地址
        $address=DB::table('address')->where('user_id','=',$id)->get();
        // var_dump($address);exit;
        if(!empty($res)){
            // 遍历shop_cart表session数据
            foreach($res as $k => $v) {
                // 获取商品表对应id的值
                $one=DB::table('goods')->where('id','=',$v['id'])->first();
                $row['name']=$one->name;
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
            // var_dump($address);exit;
            //加载订单确认页
            return view('Index.Order.Orders_confirm',['data'=>$data,'total'=>$total,'address'=>$address,'type'=>$arr,'goodon'=>$goodon]);
        }else{
            // echo 1;
            return view('Index.Order.Orders_confirm');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect("/indexorder");

        // return view('Index.Order.Orders_confirm');
        // echo 3;

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
        // 跳转添加地址页面}

    public function orderaddress(){
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        return view('Index.Order.orderaddress',['type'=>$arr,'goodon'=>$goodon]);
        // echo 1;
    }
    // 地址执行添加
    public function orderdoadd(Request $request){
        // 去除多余字段
        $data=$request->except('_token');
        // 补全字段
        $data['addtime']=date('Ymd');
        $data['uptime']=date('Ymd');
        $data['default']=1;
        $data['user_id']=session('id');
        // var_dump($data);exit;
        // 判断是否插入数据库成功
        if(DB::table('address')->insert($data)>0){
            // 成功跳转到订单确认页
            return redirect('/indexorder');
        }else{
            // 不成功跳回添加地址页
            return view('Index.Order.orderaddress');            
        }
    }
    // 地址删除
    public function deladdress($id){
        // echo $id;
        // 删除数据库数据
        if(DB::table('address')->where('id','=',$id)->delete()>0){
            return redirect('/indexorder');
        }else{
            return redirect('/indexorder');
        }
    }
    // 三级导航
    public function yiji(Request $request){
        $uid=$request->input('uid');
        $data=DB::table('district')->where('upid','=',$uid)->get();
        echo $data;
        // var_dump($data);
    }
    // 
}
