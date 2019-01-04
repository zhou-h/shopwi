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
@section('title','个人信息')
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
       @if($data->name)
          {{$data->name}}
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
          <li> <a href="/orderuser"> 我的订单</a></li>
          <li> <a href="/useraddres">收货地址</a></li>
          <!-- <li> <a href="user.php?act=booking_list"> 缺货登记</a></li> -->
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
<!--右侧样式-->
<script type="text/javascript" src="/Home/san/js/select.js"></script>
   <div class="right_style">
    <div class="info_content">
     <!--个人信息-->
      <div class="Personal_info" id="Personal">
         <div class="title_Section"><span>个人信息</span></div>
         <ul class="xinxi">
         <li><label>用户姓名：</label>  <span><input name="name" type="text" value="{{$data->name}}"  class="text"  disabled="disabled"/></span></li>
          <li><label>出身日期：</label> <span class="time">{{$data->birthday}}</span>
         <!--   <div class="add_time">
              <select name="" id="nian">
              	<option value="" b="b1">111</option>
              </select>
              <select name="">
              	<option value="" b="b2">22</option>
              	
              </select>
              <select name="sex">
              	<option value="" b="b3">33</option>
              	
              </select>
           </div> -->
           <div id="date" style="margin-left: 100px;" class="add_time">
              <select name="year" id="year">
                <option value="" b="b1"></option>
              </select>
              <select name="month" id="month">
                <option value="" b="b2"></option>
              </select>
              <select id="days" class="day">
                <option value="" b="b3"></option>
              </select>
             </div>
          </li>
          <li><label>用户性别：</label> <span class="sex">
            @if($data->sex==0)
              保密
            @elseif($data->sex==1)
              男
            @else
            女
            @endif
          </span>
          <div class="add_sex">
          			<input type="radio" name="sex" value="0" @if($data->sex==0) checked @endif>
                    保密&nbsp;&nbsp;
                    <input type="radio" name="sex" value="1" @if($data->sex==1) checked @endif>
                    男&nbsp;&nbsp;
                    <input type="radio" name="sex" value="2" @if($data->sex==2) checked @endif>
                    女&nbsp;&nbsp;
           </div></li>
          <li><label>电子邮箱：</label>  <span><input name="" type="text" value="{{$data->email}}"  class="text"  disabled="disabled"/></span></li>
                  
          <li><label>移动电话：</label>  <span><input name="" type="text" value="{{$data->phone}}"  class="text"  disabled="disabled" maxlength="11"/></span></li>
          <li><label>固定电话：</label> <span><input name="" type="text" value="{{$data->t_phone}}"  class="text"  disabled="disabled" maxlength="11"/></span></li>
          <div class="bottom"><input name="" type="submit" value="修改信息"  class="modify"/><input name="" type="submit" value="确认修改"  class="confirm"/></div>
         </ul>

         <!-- <ul class="Head_portrait">
          <li class="User_avatar"><img src="images/people.png" /></li>
          <li><input name="name" type="submit" value="上传头像"  class="submit"/></li>
          <input type="file" name="pic" style="display: none;" id="file" onchange="fileUpload()">
         </ul> -->
      </div>
    </div>
    </div>
    <script>
    var arr=[];
    // 分割生日字符串
    msg = $('.time').html();//1994 01 24
    msg = msg.split(",");
	  time = msg[0]+msg[1]+msg[2];
    $('.time').html(time);

    // 提交到修改页
    $('option[b=b1]').html(msg[0]);//年
    $('option[b=b2]').html(msg[1]);//月
    $('option[b=b3]').html(msg[2]);//日
    
     // 性别获取
     uu =1;
    $('input[name=sex]').click(function(){
          sex = $(this).val();
        // alert(sex);
        if(sex==0){
          $('.sex').html('保密');
        }else if(sex==1){
          $('.sex').html('男');
        }else if(sex==2){
          $('.sex').html('女');
        }
          uu = 2;
          arr.push(sex);
    })

    // 执行修改
    	$('.confirm').click(function(){
        var years = [];
        $('.add_time').find('select').each(function(){
        year = $(this).find('option:selected').html();
        // console.log(year);
        
        years.push(year);
        $('.time').html(years);
    });
      // 把数组转换为字符串
        b =years.join(',');
      // console.log(b);
        arr.push(b);
    
   
        $('.xinxi').attr('class','xinxi');
    		$dd= $('.xinxi').find('label').next().children().each(function(){
    			 da  = $(this).val();
           // 实现disabled
           $(this).attr('class','text');
    			 f = $(this).attr('name');
    			 arr.push(da);
    		});
    		id = {{$data->id}}
    		  arr.push(id);
         // alert(uu);
    		  $.get('/infoedit',{arr:arr,aa:uu},function(sult){
    			// alert(sult);
    			// console.log(sult);
          arr = [];
    		},'json')
    	})
    </script>
    <script>
    $(function(){
      $('#date').selectDate();
    })
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