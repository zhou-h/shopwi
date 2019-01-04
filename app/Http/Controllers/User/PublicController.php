<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use DB;
class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= DB::table('user_info')->where('user_id','=',session('id'))->first();
        $pic = $data->pic;
        session(['pic'=>$pic]);
        // echo $pic;
        // dd(session('pic'));
        return view('Index.User.public');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // echo 1111;
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
    // 头像修改
    public function editpic(Request $request){
       //修改图片
         $id = session('id');
         // dd($id);
         $info=DB::table('user_info')->where('user_id','=',$id)->first();        
         //获取pic        
         $m=".".$info->pic;
         // dd($m);
        if($request->hasFile('pic')){            
            //获取后缀            
            $extension=$request->file('pic')->getClientOriginalExtension();  
            //随机文件名字            
            $s=time()+rand(1,9999);            
            $request->file('pic')->move(Config::get('app.app_upload'),$s.".".$extension);        
            $data['pic']=trim(Config::get('app.app_upload').'/'.$s.".".$extension,".");  
            // dd($data);
            //执行数据库的修改操作            
             if(DB::table('user_info')->where('user_id','=',$id)->update($data)){                
                //删除原图 
                // if($m){
                //     unlink($m);
                // }               
                
                session(['pic'=>$data['pic']]);
                return redirect('/userinfo')->with('success','修改成功');            
            }else{                
                return redirect('/userinfo')->with('with','修改失败');            
            }        
        }else{            
            //不修改图片            
                return redirect('/userinfo')->with('with','修改失败');                             
        }
    }
}
