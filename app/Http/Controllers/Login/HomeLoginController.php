<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Mail;
class HomeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出登录 销毁session
        $request->session()->pull('id');
        $request->session()->pull('username');
        $request->session()->pull('usname');
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载前台登录模板
        return view('Index.Login.Login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取输入的用户和密码
        $username = $request->input('username');
        $password = $request->input('password');
        // echo $username."::".$password;
        // 获取数据表数据
        $info=DB::table('user')->where('username','=',$username)->first();
        // 检测用户
        if($username==''){
            return back()->with('error','请输入邮箱');
        }else if($info){
            // 检测密码
            if(Hash::check($password,$info->password)){
                if($info->status==2){
                    // 获取登录的用户头像
                    $userpic = DB::table('user_info')->where('user_id','=',$info->id)->first();
                    // 储存登录的头像
                    session(['pic'=>$userpic->pic]);
                    // 储存登录的id和用户名
                    session(['id'=>$info->id]);
                    session(['username'=>$info->username]);
                    //储存个人中心的名字
                    session(['usname'=>$userpic->name]);
                    // // 获取用户登录的用户名
                    // if(session('id')){
                    //      $name = DB::table('user_info')->where('user_id','=',session('id'))->first();
                    //   }
        // var_dump($name);exit;
                    return redirect('/');
                }else{
                    return back()->with('error','用户未激活，请先到邮箱激活');
                }
            }else{
                return back()->with('error','密码不正确');
            }
        }else{
            return back()->with('error','用户不存在');
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

    // 密码找回
    public function forget(){
        // 加载模板
        return view('Index.Fpass.fogot');
    }

     // 发送纯文本 $email 接收方 $id 注册用户id $token 校验参数
   public function sendMail($email,$id,$token){
        // 邮箱发送生成器
        Mail::send('Index.Fpass.reset',['id'=>$id,'token'=>$token],function($message)use($email){
            // 发送主题
            $message->subject('激活用户');
            // 接收方
            $message->to($email);
        });
        return true;
    }

    // 发送邮箱验证
    public function doforget(Request $request){
        // 获取邮箱
        $email = $request->email;

        // 获取输入的验证码
        $yzm = $request->yzm;
        $vcode = session('vcode');

        // 获取数据库的数据 
        if($yzm==$vcode){
            $info = DB::table('user')->where('username','=',$email)->first();
            if($info){
                
                $this->sendMail($email,$info->id,$info->token);
                return redirect('/gdforget');
            }else{
                return redirect('/forget')->with('error','请确认邮箱已注册');
            } 
        }else{
            return redirect('/forget')->with('error','验证码错误');
        }
    }


    // 邮箱发送成功
    public function gdforget(){
        return view('Index.Fpass.gdfor');
    }
    //加载密码重置数据
    public function reset(Request $request){
        // 获取id和token
        $id = $request->input('id');
        $token=$request->input('token');
        // 获取数据表数据
        $info = DB::table('user')->where('id','=',$id)->first();
        // 检测token
        // dd($info->token);
        if($token==$info->token){
            return view('Index.Fpass.resets',['id'=>$id]);
        }
    }
    // 执行密码重置
    public function doreset(Request $request){
        // 修改的id
        $id = $request->id;
        $data['password'] = Hash::make($request->input('password'));
        // 重新生成token
        $data['token']=str_random(50);
        DB::table('user')->where('id','=',$id)->update($data);
        return redirect('/success');
    }
    // 加载修改成功模板
    public function success(){
        return view('Index.Fpass.success');
    }
}
