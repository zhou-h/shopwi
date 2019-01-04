<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 获取搜索框信息
        $k = $request->input('keywords');
        //获取角色信息
        $role = DB::table('role')->where('name','like','%'.$k.'%')->paginate(5);
        // $data = DB::select('select * from role as n,role_node as rn,node where n.id=rn.rid and rn.nid=node.id and n.id=1');
        // echo "<pre>";
        // var_dump($data);exit;
        // 加载角色列表
        return view('Admin.Admins.Role.role',['role'=>$role,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $node = DB::table('node')->get();
        //加载添加角色模板
        return view('Admin.Admins.Role.role-add',['node'=>$node]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加角色
        // 添加角色表role
        $data = $request->only('name','status');
        $id = DB::table('role')->insertGetId($data);
        // 获取权限
        $nids = $_POST['nids'];
        // 添加角色相关权限到role_node表
        foreach($nids as $v){
            $node['rid']=$id;
            $node['nid']=$v;
            DB::table('role_node')->insert($node);
        }
        return redirect('/role')->with('success','
                添加角色成功');
      
    }
    //角色状态修改
    public function status(Request $request){
        // 获取状态
        $sta =$request->sta;
        // 获取id
        $id = $request->id;
        if($sta==1){
            // echo "1";
            // 改变为启用状态
            $info['status']=0;
            DB::table('role')->where('id','=',$id)->update($info);
        }elseif($sta==0){
            // echo "0";
            // 改变为关闭状态
            $info['status']=1;
            DB::table('role')->where('id','=',$id)->update($info);
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
        //修改用户
        $data = DB::table('role')->where('id','=',$id)->first();
        return view('Admin.Admins.Role.role-edit',['data'=>$data]);

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
        //执行修改
        $data = $request->only('name','status');
        if(DB::table('role')->where('id','=',$id)->update($data)){
            return redirect('/role')->with('success','角色修改成功');
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
        //
        if(DB::table('role')->where('id','=',$id)->delete()){
            DB::table('role_node')->where('rid','=',$id)->delete();
            return redirect('/role')->with('success','删除成功');
        }
    }

    // 分配权限
    public function auth($id){
        // echo "分配权限";
        // 当前角色信息
        $role = DB::table('role')->where('id','=',$id)->first();
        // 所有权限信息
        $node = DB::table('node')->get();
        // 获取也有的权限信息
        $data = DB::table('role_node')->where('rid','=',$id)->get();
        if(count($data)){
            // 遍历
            foreach($data as $v){
                $nids[]=$v->nid;
            }
            return view('Admin.Admins.Role.role-list',['role'=>$role,'node'=>$node,'nids'=>$nids]);
        }else{
            return view('Admin.Admins.Role.role-list',['role'=>$role,'node'=>$node,'nids'=>array()]);
        }

    }
    // 保存权限
    public function saveauth(Request $request){
        // 获取分配的权限信息
        $nid = $_POST['nids'];
        // 获取角色rid
        $rid = $request->input('rid');
        // 删除已有的权限信息
        DB::table('role_node')->where('rid','=',$rid)->delete();
        // 遍历
        foreach($nid as $v){
            // 封装需要插入的数据
            $data['rid'] = $rid;
            $data['nid'] = $v;
            // 执行插入
            DB::table('role_node')->insert($data);
        }
        // 跳转会角色列表
        return redirect('role')->with('success','权限分配成功');
    }


}
