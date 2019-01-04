<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入第三方
use Gregwar\Captcha\CaptchaBuilder;
use Mail;
use Hash;
use DB;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //邮箱注册
        return view('Index.Login.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 判断是否已经注册
    public function emails(Request $request){
        $str = $request->input('str');
        $stes = DB::table('user')->where('username',$str)->first();
        if($stes){
            echo "1";
        }else{
            echo "2";
        }
        

    }
    // 发送纯文本 $email 接收方 $id 注册用户id $token 校验参数
    public function sendMail($email,$id,$token){
        // 邮箱发送生成器
        Mail::send('Index.Login.huo',['id'=>$id,'token'=>$token],function($message)use($email){
            // 发送主题
            $message->subject('激活用户');
            // 接收方
            $message->to($email);
        });
        return true;
    }
    public function store(Request $request)
    {   
        // 设置闪存
        $request->flashOnly('username','password','repassword') ;
        //获取输入的校验码
        $code = $request->input('code');
        // 获取系统的校验码
        $vcode = session('vcode');
        // echo $code.":".$vcode;
        // 对比校验码
        if($code==$vcode){
            // echo "ok";
            $data = $request->except('repassword','code','_token');
           // 密码加密
            $data['password'] = Hash::make($data['password']);
            $data['status']=0;//没激活
            $data['addtime']=time();
            $data['uptime']=time();
            $data['token']=rand(1,10000);
            // var_dump($data);exit;
            // 入库同时获取id
            $id = DB::table('user')->insertGetId($data);
            // 创建个人信息
            $info['user_id']=$id;
            DB::table('user_info')->insert($info);
            if($id){
                $res=$this->sendMail($data['username'],$id,$data['token']);
                if($res){
                   return redirect('/register/create')->with('suok','注册成功,请前往pc端登录邮箱激活');

                }
            }
        }else{
            return back()->with('error','校验码有误');
        }
    }

    // 激活方法
    public function jihuo(Request $request){
        // 获取id和token
        $id = $request->input('id');
        $token=$request->input('token');

        // 对比 邮件里的token和数据表token是否一致
        $info = DB::table('user')->where('id','=',$id)->first();
        // echo $id.'='.$token;exit;
        if($token==$info->token){
            // 把status改变
            $data['status']=2;
            // 给token从新赋值
            $data['token']=rand(1,10000);
            // var_dump($data);exit;
            DB::table('user')->where('id','=',$id)->update($data);
            echo "用户激活成功";

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

    // 测试邮箱发送
    public function send(){
        // 邮箱发送生成器
        Mail::raw('this',function($message){
            // 发送主题
            $message->subject('8989');
            // 接收方
            $message->to('597837561@qq.com');
        });
    }
    // 测试验证码
    public function code(){
        //生成校验码代码
        ob_clean();//清除操作
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 50, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        //输出校验码
        $builder->output();
        // die;
    }
    
}
