<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Goods;
use App\Models\Type;
class UserinfoController extends Controller
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
        //
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        $data = DB::table('user_info')->where('user_id','=',session('id'))->first();
        return view('Index.User.Userinfo.userinfo',['data'=>$data,'goodon'=>$goodon,'type'=>$arr]);
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
        echo "11";
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

    // ajax修改
    public function editfo(Request $request){
        $data = $request->arr;
        $aa = $request->input('aa');
        // echo $aa;
        // 判断是否修改了性别 1未修改
        if($aa==1){
                  $userinfo['birthday'] = $data['0'];//生日
                  $userinfo['name']=$data['1'];//姓名
                  $userinfo['email']=$data['2'];//邮箱
                  $userinfo['phone']=$data['3'];//移动电话
                  $userinfo['t_phone']=$data['4'];//固定电话
                  $id=$data['5'];//user_id用户id  
        }elseif($aa==2){
                  $userinfo['sex'] = $data['0'];//性别
                  $userinfo['birthday'] = $data['1'];//生日
                  $userinfo['name']=$data['2'];//姓名
                  $userinfo['email']=$data['3'];//邮箱
                  $userinfo['phone']=$data['4'];//移动电话
                  $userinfo['t_phone']=$data['5'];//固定电话
                  $id=$data['6'];//user_id用户id  
        }
        // 
        // dd($data);
        // dd($userinfo);
        session(['usname'=>$userinfo['name']]);
        $dd = DB::table('user_info')->where('id','=',$id)->update($userinfo);
    }
}
