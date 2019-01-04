<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入添加校验码
use App\Http\Requests\Adminsinsert;
// 修改校验码
use App\Http\Requests\Adminsedit;
use DB;
use Hash;
class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // echo '999';
        $k = $request->input('keywords');
        // 获取数据
        $admin = DB::table('admin_user')->where('username','like','%'.$k.'%')->paginate(5);
        //加载管理员列表页面 
        // dd($admin);
        return view('Admin.Admins.admins',['admin'=>$admin,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载添加管理员页面
        return view('Admin.Admins.kiss-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Adminsinsert $request)
    {
        // 获取添加信息
        $data = $request->only('username','password');
        // 密码加密
        $data['password']=Hash::make($data['password']);
        if(DB::table('admin_user')->insert($data)){
            return redirect('/admins')->with('success','添加成功');
        }else{
            return redirect('/admins/create')->with('error','添加失败');

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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  管理员修改
        $data = DB::table('admin_user')->where('id','=',$id)->first();
        // $data['password']=Hashids::chek($data->password);
        // dd($data);
        return view('Admin.Admins.admins-edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Adminsedit $request, $id)
    {
        // 执行修改
        $data = $request->only('username','password');
        // 密码加密
        $data['password']=Hash::make($data['password']);
        if(DB::table('admin_user')->where('id','=',$id)->update($data)){
            return redirect('/admins')->with('success','修改成功');
        }else{
            return redirect('/admins/{$id}/edit')->with('error','修改失败');

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
        //删除管理员
        if(DB::table('admin_user')->where('id','=',$id)->delete()){
            return redirect('/admins')->with('success','删除成功');
        }else{
            return redirect('/admins')->with('error','删除失败');
        }
    }

    // 分配角色
    public function rolelist($id){
        // echo "分配角色";
        // 获取管理员信息
        $info = DB::table('admin_user')->where('id','=',$id)->first();
        // 获取所有角色信息
        $role = DB::table('role')->get();
        // 获取当前管理员已有的角色信息
        $data = DB::table('user_role')->where('uid','=',$id)->get();
        // dd($data);
        if(count($data)){
            //遍历
            foreach($data as $v){
                $rids[]=$v->rid;
            }
            // 加载角色列表模板
        return view('Admin.Admins.rolelist',['info'=>$info,'role'=>$role,'rids'=>$rids]);
        }else{
            return view('Admin.Admins.rolelist',['info'=>$info,'role'=>$role,'rids'=>array()]);
        }
    }

    // 保存角色
    public function saverole(Request $request){
        // echo "保存角色";
        // 获取rids　参数　选中的角色id
        $rids = $_POST['rids'];
        // 获取用户id
        $uid = $request->input('uid');
        // 把已有的角色删除
        DB::table('user_role')->where('uid','=',$uid)->delete();
        //遍历数组$rids
        foreach($rids as $v){
            // 封装需要插入的数据
            $data['rid']=$v;
            $data['uid']=$uid;
            // 执行
            DB::table('user_role')->insert($data);
        }
        return redirect('admins')->with('success','角色分配成功');
    }
}
