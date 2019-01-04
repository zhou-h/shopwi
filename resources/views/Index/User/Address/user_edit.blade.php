@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/sumoselect.css" rel="stylesheet"  type="text/css"/>
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script> 
<script src="/Home/js/jquery.sumoselect.js"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
@endsection
@section('main')
@section('title','修改密码')
<html>
 <head></head>

 <style>
 .modify_Addresss{
 	    width: 980px;
	    background: #eee;
	    height: 419px;
	    margin-left: 225px;
     }
     .addsss{
     	margin-left: 100px;
   		margin-top: 10px;
     }
     #submit{
     	position: relative;
	    margin: 320px 0 0 -245px;
	    height: 35px;
	    width: 80px;
	    background: #ff7200;
	    border: 1px solid #ff7200;
     }
     .defa{
     	width: 119px;
	    margin-left: -5px;
	    background: red;
	    height: 0px;
	    color: red;
	    font-size: 14px;
     }
 </style>
    <!-- <script src="http://www.jq22.com/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="/Home/san/addstatic/distpicker.data.js"></script>
    <script src="/Home/san/addstatic/distpicker.js"></script>
    <script src="/Home/san/addstatic/main.js"></script>
 <body>
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
   <div class="modify_Addresss">
   <div class="addsss">
   <span style="font-size: 24px;margin-left: -90px">修改地址</span>
   <form action="/useraddres/{{$data->id}}" method="post" id="foadd">
    <ul>
     <li class="user_Addresss"><label>配送区域</label>
         <div id="distpicker5">
          <select class="form-control" id="province10" dd="d1" name="ad1"></select>
          <select class="form-control" id="city10" dd="d2" name="ad2"></select>
          <select class="form-control" id="district10" dd="d3" name="ad3"></select>
        </div>
      <input type="hidden" name="address" value="{{$data->address}}" id="add_user">
     </li>
     <li class="user_Addresss"><label> 详细地址 </label><input name="addre_s" type="text" class="xi_Address Add_text ppa" value="{{$data->addre_s}}" /><span>(必填)</span></li>
     <li><label>收件人</label><input name="name" type="text" class="Add_text ppb" value="{{$data->name}}" /><span>(必填)</span></li>
     <li><label>电子邮箱</label><input name="email" type="text" class="Add_text " value="{{$data->email}}" /></li>
     <li><label>邮政编码</label><input name="pc" type="text" class="Add_text ppc" value="{{$data->pc}}" /><span>(必填)</span></li>
     <li><label>固定电话</label><input name="t_phone" type="text" class="Add_text" value="{{$data->t_phone}}" maxlength="11"/></li>
     <li><label>移动手机</label><input name="phone" type="text" class="Add_text ppd" value="{{$data->phone}}" maxlength="11"/><span>(必填)</span></li>
     <li><label>送货时间</label><input name="addtime" type="text" class="Add_text" value="{{$data->addtime}}" /></li>
     <div class="defa"><input type="checkbox" name="default" value="1"  />设置为默认地址</div>
     <input type="submit" value="确认修改" id="submit">
    </ul>

	{{csrf_field()}}
	{{method_field('PUT')}}
    </form>
   </div>
  
  </div>
 </body>
 <script>
 var  arr = [];
 // 修改地址
 add = $('#add_user').val();
 // 分割字符串
 msg = add.split(',');
 $op = $()
$('option[dd=d1]').html(msg[0]);//省
$('option[dd=d2]').html(msg[1]);//市
$('option[dd=d3]').html(msg[2]);//区
$('option[dd=d4]').html(msg[3]);//县
// console.log(msg);
// 组合地址
// $('.user_Addresss').find('select').each(function(){
//     // option = $(this).find('option:selected').html();
//     option = $(this).val();
//     console.log(option)
    
//     arr.push(option);
// })
$('#add_user').val(arr);
// 正则
 var oop1 = false;
 var oop2 = false;
 var oop3 = false;
 var oop4 = false;
 // alert($('.ppa').val());
 //地址详情
  $('.ppa').blur(function(){
    ppa = $(this).val();
    if(ppa==''){
      $(this).next().css('color','green');
      oop1=false;
    }else{
      $(this).next().css('color','#ff6700');
      oop1=true;
    }
  })
  // 收件人
   $('.ppb').blur(function(){
    ppb = $(this).val();
    if(ppb==''){
      $(this).next().css('color','green');
      oop2=false;
    }else{
      $(this).next().css('color','#ff6700');
      oop2=true;
    }
  })
   // 邮编
     $('.ppc').blur(function(){
    ppc = $(this).val();
    if(ppc==''){
      $(this).next().css('color','green');
      oop3=false;
    }else{
      $(this).next().css('color','#ff6700');
      oop3=true;
    }
  })
     // 电话
       $('.ppd').blur(function(){
    ppd = $(this).val();
    if(ppd==''){
      $(this).next().css('color','green');
      oop4=false;
    }else{
      $(this).next().css('color','#ff6700');
      oop4=true;
    }
  })
  // 提交表单
  $('#foadd').submit(function(){
    $('input').trigger('blur');
    if(oop1 && oop2 && oop3 && oop4){
      return true;
    }else{
      return false;
    }
  })
 </script>
</html>
@endsection