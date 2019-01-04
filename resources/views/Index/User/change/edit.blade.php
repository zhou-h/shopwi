@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<script src="/Home/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
@endsection
@section('main')
@section('title','修改密码')
 <div class="user_style clearfix">
    <div class="user_center">
      <!--左侧菜单栏-->
  <div class="left_style">
    <div class="menu_style">
     <div class="user_title">用户中心</div>
     <div class="user_Head">
     <div class="user_portrait">

      <form action="/editpic" method="post" enctype="multipart/form-data">
              <input type="file" name="pic" style="display:none;" id="file" onchange="fileUpload()" >
          <input type="submit" value="上传头像" id="submit" style="display: none;" />
      {{csrf_field()}}
          </form>

      <a href="#" title="修改头像" class="btn_link"></a> <img src="{{session('pic')}}">
      <div class="background_img"></div>
      </div>
      <div class="user_name">
       <p><span class="name">
          @if(session('usname'))
           {{session('usname')}}
           @else
           未设置
           @endif
       </span><a href="/userchange/create">[修改密码]</a></p>
       <p>访问时间：2016-1-21 10:23</p>
       </div>           
     </div>
     <div class="sideMen">
     <!--菜单列表图层-->
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_1"></em>订单中心</dt>
      <dd>
        <ul>
          <li> <a href="User_Orderform.html"> 我的订单</a></li>
          <li> <a href="/useraddres">收货地址</a></li>
          <li> <a href="user.php?act=booking_list"> 缺货登记</a></li>
        </ul>
      </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_2"></em>会员中心</dt>
        <dd>
      <ul>
        <li> <a href="/userinfo"> 用户信息</a></li>
        <li> <a href="user.php?act=collection_list"> 我的收藏</a></li>
        <li> <a href="user.php?act=message_list"> 我的留言</a></li>
        <li> <a href="user.php?act=tag_list">我的标签</a></li>
        <li> <a href="user.php?act=affiliate"> 我的推荐</a></li>
        <li><a href="user.php?act=comment_list"> 我的评论</a></li>
      </ul>
    </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_3"></em>账户中心</dt>
      <dd>
       <ul>
      <li> <a href="User_coupon.html">我的优惠劵</a></li>
      <li><a href="user.php?act=group_buy">我的团购</a></li>
       <li> <a href="user.php?act=track_packages"> 跟踪包裹</a></li>
       <li> <a href="User_funds.html"> 资金管理</a></li>
      </ul>
     </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_4"></em>分销中心</dt>
      <dd>
        <ul>
          <li> <a href="user.php?act=myshop">店铺管理</a></li>
          <li> <a href="user.php?act=myguide">我的盟友</a></li>
          <li> <a href="user.php?act=myaccount"> 我的佣金</a></li>
          <li> <a href="user.php?act=account_raply">申请提现</a></li>
        </ul>
      </dd>
    </dl>
    </div>
      <script>jQuery(".sideMen").slide({titCell:"dt", targetCell:"dd",trigger:"click",defaultIndex:0,effect:"slideDown",delayTime:300,returnDefault:true});</script>
   </div>  
  </div>
  <!--右侧样式-->
<div class="right_style">
     <div class="info_content">
      <!--修改密码样式-->
      <form action="/userchange" method="post" id="foms">
       <div class="change_Password">
           <div class="title_Section"><span>修改密码</span></div>
           <ul class="p_modify">
              <div class="Note">暂只支持原密码修改，不支持邮箱电话验证密码修改</div>
              <li><label>原密码</label><input name="oldpassword" type="Password" class="text_Password" id="old">
              <span id="oldpass" style="color: rgb(255, 0, 0)"></span></li></li>
              <li class="new_password">
                <label>新密码</label>
                <div class="ywz_zhuce_xiaoxiaobao">
			  <div class="ywz_zhuce_kuangzi"><input name="newpassword" type="password" id="tbPassword" class="ywz_zhuce_kuangwenzi1 text_Password"></div>
			<div class="ywz_zhuce_huixian" id="pwdLevel_1">弱 </div>
			<div class="ywz_zhuce_huixian" id="pwdLevel_2">中 </div>
			<div class="ywz_zhuce_huixian" id="pwdLevel_3">强 </div>
		     </div>
            <div class="ywz_zhuce_yongyu1">
            <span id="pwd_err" style="color: rgb(255, 0, 0)"></span>
		     </div>
              </li>            
              <li><label>确认密码</label><input name="repassword" type="Password" class="text_Password" id="repass">
              <span id="repwd_err" style="color: rgb(255, 0, 0)"></span></li>
              <div style="text-align: center;">
              @if(session('error'))
              <span id="oldpass" style="color: rgb(255, 0, 0)">{{session('error')}}</span>
              @endif

              @if(session('success'))
              <span id="oldpass" style="color:yellowgreen">{{session('success')}}</span>
              @endif
              </div>
              
              <li><input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="确认修改"></li>
           </ul>
       </div>
       {{csrf_field()}}
       </form>
     </div>
    </div>
    <script>
    var	upp =false;
    var aap =false;
    	// 原密码
    	$('#old').focus(function(){
    		$('#oldpass').html('输入原密码').css('font-size','12px');
    	});
    	$('#old').blur(function(){
    		strr = $(this).val();
    		if(strr==''){
    			$('#oldpass').html('请输入原密码').css('font-size','12px');
    			upp=false;
    		}else{
    			$('#oldpass').html('').css('font-size','12px');
    			upp=true;
    		}
    	});
    	$('#tbPassword').focus(function(){
    		$('#pwd_err').html('6-16位，由字母（区分大小写）、数字、符号组成');
    	});
    	$('#tbPassword').blur(function(){
    		str = $(this).val();
    		if(str==''){
    			$('#pwd_err').html('密码为空');
    			upp = false;
    		}else if(str.match(/^(?![0-9]*$)[a-zA-Z0-9]{6,18}$/)!==null){
    			$('#pwd_err').html('密码符合').css('color','red');
          // alert(123);
    			upp=true;
    		}else{
    			$('#pwd_err').html('密码不符合').css('color','red');
    			upp=false;
    		}
    	});
    	// 重复密码
    	$('#repass').blur(function(){
    		str1 = $(this).val();
    		if(str1==""){
    			$('#repwd_err').html('请输入重复密码').css('font-size','12px').css('color','red');
    			aap=false;
    		}else if(str==str1){
    			$('#repwd_err').html('密码一致').css('color','green').css('font-size','12px');
    			aap=true;
    		}else{
    			$('#repwd_err').html('密码不一致').css('font-size','12px').css('color','red');
    			aap=false;
    		}
    	});

    	// 表单提交
  $('#foms').submit(function(){
  $("input").trigger("blur");
    if(upp && aap){
      return true;
    }else{
      return false;
    }
  });
    </script>
    <script>
      $('.btn_link').click(function(){

        $("#file").trigger("click");
      })
      function fileUpload(){
        $("#submit").trigger("click");
      }
      </script>
@endsection
