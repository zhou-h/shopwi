<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class AddressController extends Controller
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

        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        $data = DB::table('user_info')->where('user_id','=',session('id'))->first();
        // 获取用户的所有地址
        $id = session('id');
        $data = DB::table('address')->where('user_id','=',$id)->get();
        // 用户收货地址模板
        return view('Index.User.Address.address',['data'=>$data,'goodon'=>$goodon,'type'=>$arr]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //获取添加地址数据

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
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        $data = DB::table('user_info')->where('user_id','=',session('id'))->first();
        $data = DB::table('address')->where('id','=',$id)->first();
        return view('Index.User.Address.user_edit',['data'=>$data,'goodon'=>$goodon,'type'=>$arr]);
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
        $data = $request->except('_token','_method');
        $dea = $request->input('ad1');
        // dd($data);
        if($dea!=''){
            // 拼接地址
            $str = $request->input('ad1').','.$request->input('ad2').','.$request->input('ad3');
            // 从新编辑修改地址
            $info['address'] = $str;
        }
        // 修改时间
        $info['uptime']=time();
        $info['addre_s']=$request->input('addre_s');
        $info['name']=$request->input('name');
        $info['email']=$request->input('email');
        $info['pc']=$request->input('pc');
        $info['t_phone']=$request->input('t_phone');
        $info['phone']=$request->input('phone');
        $info['addtime']=$request->input('addtime');
        // 这是默认地址字段
        if($request->input('default')){
            $info['default']=$request->input('default');
        }
        // 判断是否已存在默认地址
        $default = DB::table('address')->where('default','=',1)->first();
        // 判断是否设置了默认地址
        $fid=$request->default;
        if($fid){
            // 判断是否已存在默认地址
            if($default){
                // 获取与存在的默认地址的id
                $eid = $default->id; 
                $defalse['default']=0;
                // 取消默认地址
                DB::table('address')->where('id','=',$eid)->update($defalse);
            }
        }
        $db = DB::table('address')->where('id','=',$id)->update($info);

        if($db){
            return redirect('/useraddres')->with('success','修改成功');
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
        //删除地址
    }

    // 删除地址
    public function delete(Request $request){
        // 获取删除的id
        $id = $request->id;
        if(DB::table('address')->where('id','=',$id)->delete()){
            echo 1;
        }
    }
    public function addre(Request $request){
        // 获取数据
        $data = $request->except('_token');
        // 获取登录的用户id
        $id = session('id');
        $data['user_id']=$id;
        // 0  不是默认 0是默认地址
        $data['default']=0;
        // 添加时间 //送货
        $data['addtime']=time();
        // dd($data);
        $sum = DB::table('address')->where('user_id','=',$id)->count();
        if($sum>=5){
            return redirect('/useraddres')->with('success','只可以添加5个地址');
        }else{
            $db = DB::table('address')->insert($data);
            return redirect('/useraddres')->with('success','地址添加成功');
        }
    }
    // 三级联动地址
    public function address(Request $request){
        // 获取传过来的地址id
        $id = $request->input('upid');
        $data = DB::table('district')->where('upid','=',$id)->get();
        echo json_encode($data);
      
    }
    //默认地址切换
    public function addajax(Request $request){
        $id = $request->input('id');
        $info['default']=1;
        // 改变已存在的默认地址
        $default=DB::table('address')->where('default','=',1)->first();
        if($default){
            $fid = $default->id;
            $defa['default']=0;
            DB::table('address')->where('id','=',$fid)->update($defa);
        }
        DB::table('address')->where('id','=',$id)->update($info);
    }
}
