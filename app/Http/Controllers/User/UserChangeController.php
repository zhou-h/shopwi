<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
//引入模型类
use App\Models\Goods;
use App\Models\Type;
class UserChangeController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //名字
        $data = DB::table('user_info')->where('user_id','=',session('id'))->first();
        $arr=$this->getTypecode(0);
        //栏目商品
        $goodon=Goods::where('static','=','0')->orderBy('sales','DESC')->paginate(2);
        //用户修改密码
        return view('Index.User.change.edit',['goodon'=>$goodon,'type'=>$arr,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取数据
         $id = session('id');
         // 输入的原密码密码
        $oldpassword = $request->input('oldpassword');
        // 新密码
        $newpassword = $request->input('newpassword');
        // 
        $data['password']=Hash::make($newpassword);
        $info = DB::table('user')->where('id','=',$id)->first();
        // 判断原密码
        if(!Hash::check($oldpassword,$info->password)){
            return redirect('/userchange/create')->with('error','原密码不正确');
        }else{
            DB::table('user')->where('id','=',$id)->update($data);
            return redirect('/userchange/create')->with('success','密码修改成功');
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
}
