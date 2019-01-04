<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/Home/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<title>用户注册</title>
</head>

<body>
<div class="Reg_log_style">
 <div class="logo"><a href="#"><img src="/Home/images/logo.png" /></a></div>
  <div class="regist_style">
 <div class="left_img"><img src="/Home/images/bg_name_03.png" /></div>
 <div class="right_img"><img src="/Home/images/bg_name_05.png" /></div>
 <form id="myform" class="sign_area" autocomplete="off" action="/register" method="post">
 <div class="title_name"><a href="/login/create"><span style="">注册</span></a></div>
    <div class="regist_m_1">
    @if(session('suok'))
     <p style="margin-top: -20px;font-size: 24px;color: red;text-align: center;">{{session('suok')}}</p>
     @endif
     <div class="add_regist">
      <ul>
   <li class="frame_style user2" style=""><label class="user_icon"></label><input name="username" type="text"  id="user_text"/ placeholder="请输入邮箱" class="user" value="{{old('username')}}"></li>
   <font id="user1"></font>
   <li class="frame_style " style="" id="pass2"><label class="password_icon"></label><input name="password" type="password"   id="tbPassword"  class="ywz_zhuce_kuangwenzi1 text_Password pass"/ placeholder="设置密码" value="{{old('password')}}"></li> 
   <font id="pass1"></font><br />   
    <div class="ywz_zhuce_xiaoxiaobao pass3">
      <div class="ywz_zhuce_huixian" id="pwdLevel_1">弱 </div>
      <div class="ywz_zhuce_huixian" id="pwdLevel_2">中 </div>
      <div class="ywz_zhuce_huixian" id="pwdLevel_3">强 </div>
    </div>            
   <li class="frame_style repass2"><label class="password_icon"></label><input name="repassword" type="password"   id="confirm_pwd_text" placeholder="确认密码" class="repass" value="{{old('repassword')}}" /></li>
   <font class="repass1"></font>
   <li class="frame_style" style="cursor: pointer;"><label class="Codes_icon"></label><input name="code" type="text"   id="Codes_text" placeholder="验证码" /><div class="Codes_region"><img src="/code" onclick="this.src=this.src+'?a=1'" /></div></li>
   <font style="color: red">@if(session('error'))
          {{session('error')}}
          @endif
   </font>
  </ul>
    <div class="auto_login clearfix">
					 	<p class="clearfix">
                    	<a id="check_agreement" href="#" class="check_agreement">我已阅读相关规定</a>
                    	<input id="autoLoginCheck" type="hidden">
                    	<span id="agreement_tips" class="auto_tips" style=""></span>
                        </p>  
                        <a href="#" target="_blank" class="forget_pswd" tabindex="-1">《商城用户协议》</a>                     
                    </div>
  <div class="center clearfix" ><input class="btn_pink" id="btn_signin" href="javascript:void(0)" style="width: 460px" type="submit" value="立即注册" disabled="true">
  </div>
     </div>
    </div>
    {{csrf_field()}}
 </form>
 </div>
</div>
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br>

    </div>    	
</div>
</body>
<script>
  // alert($);
 var PHONE=false;
 var CODE =false;
  // 邮箱验证
  // $('.user').focus();
  $('.user').blur(function(){
    str = $(this).val();
    if(str==''){
      $('#user1').html('输入的邮箱为空，请输入邮箱').css('color','red');
      $('.user2').css('margin-bottom','5px');
      PHONE=false;
    }else if(str.match(/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/)!==null){
        // 判断是否已经被注册
        $.get('/emails',{str:str},function(data){
          if(data==1){
            $('#user1').html('该邮箱已经注册').css('color','red');
          $('.user2').css('margin-bottom','5px');
          PHONE=false;
          }else{
            $('#user1').html('邮箱可以使用').css('color','green');
          $('.user2').css('margin-bottom','5px');
          PHONE=true;
          }
        });
    }else{
      $('#user1').html('邮箱格式不正确,请注意格式!').css('color','red');
      $('.user2').css('margin-bottom','5px');
      PHONE=false;
    }
  });
  $('.pass').blur(function(){
    str1 = $(this).val();
    if(str1==''){
      $('#pass1').html('密码不能为空').css('color','red');
      $('#pass2').css('margin-bottom','5px');
      $('.pass3').css('margin-top','15px');
      CODE=false;
    }else{
      $('#pass1').html('密码可以使用').css('color','green');
      $('#pass2').css('margin-bottom','5px');
      $('.pass3').css('margin-top','15px');
      CODE=true;
    }
  });

  // 确认密码
  $('.repass').blur(function(){
    str2 = $(this).val();
    if(str2==''){
      $('.repass1').html('重复密码为空').css('color','red');
      $('.repass2').css('margin-bottom','5px');
      CODE=false;
    }else{
      if(str1==str2){
        $('.repass1').html('密码一致').css('color','green');
        $('.repass2').css('margin-bottom','5px');
        CODE=true;
      }else{
        $('.repass1').html('两次密码不一致').css('color','red');
        $('.repass2').css('margin-bottom','5px');
        CODE=false;
      }
      
    }
  });
  // 
  $d = $('#check_agreement').attr('class');
  // alert($d);
  $('#check_agreement').click(function(){
    $dd = $('#btn_signin').attr('disabled');
    $('#btn_signin').attr('disabled',!$dd);
  })

  // 表单提交
  $('#myform').submit(function(){
  $("input").trigger("blur");
    if(PHONE && CODE){
      return true;
    }else{
      return false;
    }
  });
</script>
</html>
