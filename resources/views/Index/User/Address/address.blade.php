@extends('Index.public.public')
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
          <li> <a href="/orderuser"> 我的订单</a></li>
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
     <!--地址管理样式-->
      <div class="adderss_style">
        <div class="title_Section"><span>收货地址管理</span></div>
        <div class="adderss_list">
          <!--地址列表-->
      <div class="Address_List clearfix suo"> 
        <!--地址类表-->
        @foreach($data as $row)
           <ul class="Address_info info">
            <div class="address_title" add="{{$row->id}}" default="{{$row->default}}">
            <a href="useraddres/{{$row->id}}/edit" class="modify iconfont icon-fankui btn " title="修改信息" data-toggle="modal" id="purebox"></a>
            地址信息
            <a name="{{$row->id}}" class="delete"><i class="iconfont icon-close2" style="color: red"></i></a>
            </div>
            <li><label style="color: red"></label>{{$row->name}}</li>
            <li><label style="color: red"></label>{{$row->address}} {{$row->addre_s}}</li>
            <li><label style="color: red"></label>{{$row->phone}}</li>
            <li><label style="color: red"></label>{{$row->pc}}</li>
           </ul>
           @endforeach
         </div>
        </div>
        <form action="/addre" method="post" onsubmit="false" id="foadd">
        <div class="Add_Addresss">
             <div class="title_name"><i></i>添加地址</div>
             <table>
              <tbody><tr>
               <td class="label_name">收货区域</td>
               <td colspan="3" class="select">

               <select name="" id="sid" class="sids">
                    <option value="" class="ss" style="margin-right: 25px">--请选择--</option>
               </select>
                    <input type="hidden" name="address">
               
               <font style="color: #ff6700">*选择收货地址</font>
               </td></tr>
               <tr><td class="label_name">详细地址</td><td><input name="addre_s" type="text" class="Add-text ppa" ><i>（*必填）</i></td>
              <td class="label_name">送货时间</td><td><input name="addtime" type="text" class="Add-text"><i>（选填）</i></td></tr>
              <tr>
              <td class="label_name">收件人姓名</td><td><input name="name" type="text" class="Add-text ppb"><i>（*必填）</i></td>
              <td class="label_name">电子邮箱</td><td><input name="email" type="text" class="Add-text"><i>（选填）</i></td>
              </tr>
              <tr>
              <td class="label_name">邮&nbsp;&nbsp;编</td><td><input name="pc" type="text" class="Add-text ppc"><i>（*必填）</i></td>
              <td class="label_name">手&nbsp;&nbsp;机</td><td><input name="phone" type="text" class="Add-text ppd" maxlength="11"><i>（*必填）</i></td>           
              </tr>
              <tr>
              <td class="label_name">固定电话</td><td><input name="t_phone" type="text" class="Add-text" maxlength="11"><i>（选填）</i></td></tr>
              <tr><td class="label_name"></td><td></td><td class="label_name"></td><td></td>
              </tr>             
             </tbody></table>
             <div class="address_Note"><span>注：</span>只能添加5个收货地址信息。请乎用假名填写地址，如造成损失由收货人自己承担。</div>
             <div class="btn"><input name="" type="submit" value="添加地址" class="Add_btn"></div>
             
         </div>
         {{csrf_field()}}
       </form>
      </div>
     </div> 
   </div>
   <script>
   $('.address_title').each(function(){
   		var dd = $(this).attr('default');
   		// alert(dd);
   		if(dd==1){
   			$(this).parent().css('border','2px solid #ff6700');
   		}
   })
   $('.info').click(function(){
      $(this).css('border','2px solid #ff6700');
      background: ;
      $(this).siblings().css("border","2px solid #ccc");
      // sta = $(this).find('.address_title').attr('default');
      // 地址id
      id = $(this).find('.address_title').attr('add');
      $.get('/addajx',{id:id},function(data){
        // alert(data);
      })
   })
   </script>
   <!-- <script src="/Home/purebox/bootstrap-transition.js"></script> -->
	<script src="/Home/purebox/application.js"></script>	
	<script src="/Home/purebox/bootstrap-alert.js"></script>
	<script src="/Home/purebox/bootstrap-modal.js"></script>
	<script src="/Home/purebox/bootstrap-dropdown.js"></script>
	<script src="/Home/purebox/bootstrap-scrollspy.js"></script>
	<script src="/Home/purebox/bootstrap-tab.js"></script>
	<script src="/Home/purebox/bootstrap-tooltip.js"></script>
	<script src="/Home/purebox/bootstrap-popover.js"></script>
	<script src="/Home/purebox/bootstrap-button.js"></script>
	<script src="/Home/purebox/bootstrap-collapse.js"></script>
	<script src="/Home/purebox/bootstrap-carousel.js"></script>
	<script src="/Home/purebox/bootstrap-typeahead.js"></script>
	<script src="/Home/purebox/bootstrap-affix.js"></script>
	<script src="/Home/purebox/holder/holder.js"></script>
	<script src="/Home/purebox/google-code-prettify/prettify.js"></script>	
	<script src="/Home/purebox/jquery.purebox.js"></script>
	<script src="/Home/purebox/jquery.resizable.js"></script>     
   <script>
   $('.delete').click(function(){
   		ss = confirm('确定删除吗');
   		id = $(this).attr('name');
   		// alert(id);
   		d = $(this).parents('ul');
   		if(ss){
   			$.get('/addrdel',{id:id},function(sdel){
   				if(sdel==1){
   					d.remove();
   				}
   			});
   		}
   })
  //获取第一级别
  $.get('/addr',{'upid':0},function(result){
    // console.log(result);
    //得到的数据数字内容 遍历得到里面的一个对象
    for(var i=0;i<result.length;i++){
      // console.log(result[i].name);
      //将名称写入option
      var info = $('<option value="'+result[i].id+'">'+result[i].name+'</option>');
      // console.log(info);
      //放到select标签列表中
      $('#sid').append(info);
    $('.ss').attr('disabled',true);

    }
    //禁止请选择被选中
  },'json');
  //-----------其他级别内容-------------
  //事件委派live  可以帮助我们将动态生成的内容只要选中器相同就可以有相应的事件
  $('select').live('change',function(){
    //将当前的对象储存起来
    obj = $(this);
    //通过id来查找下一个
    id = $(this).val();
    //清除其他的select
    // alert(id);
    obj.nextAll('select').remove();
    $.getJSON('/addr',{'upid':id},function(result){
      // alert(result);
      if(result!=''){
        var select = $('<select class="sids"></select>');
        var op = $('<option class="mm">--请选择--</option>');
        select.append(op);

        //循环输出相应城市内容
        for(var i=0;i<result.length;i++){
          // console.log(result[i].name);
          var info = $('<option value="'+result[i].id+'">'+result[i].name+'</option>');
          select.append(info);
        }
        obj.after(select);
      }
      $('.mm').attr('disabled',true);
    })
  })
  var arr = [];
  //获取选中的数据提交到操作页面
  $(':submit').click(function(){
    // console.log($('select'));
    $('.sids').each(function(){
      opdata = $(this).find('option:selected').html();
      //将得到的值放到数组中
        arr.push(opdata);
      	// console.log(arr);
    })
    //将得到的数组直接赋值给隐藏域的value
    $('input[name=address]').val(arr);
  })
  // console.log(arr);
  // 正则判断
  var pd1 = false;
  var pd2 = true;
  var pd3 = true;
  var pd4 = true;
  //地址详情
  $('.ppa').blur(function(){
    ppa = $(this).val();
    if(ppa==''){
      $(this).next().css('color','red');
      pd1=false;
    }else{
      $(this).next().css('color','#ff6700');
      pd1=true;
    }
  })
  // 收件人
  $('.ppb').blur(function(){
    ppb = $(this).val();
    if(ppb==''){
      $(this).next().css('color','red');
      pd2=false;
    }else{
      $(this).next().css('color','#ff6700');
      pd2=true;
    }
  })
  // 邮编
  $('.ppc').blur(function(){
    ppc = $(this).val();
    if(ppc==''){
      $(this).next().css('color','red');
      pd3=false;
    }else{
      $(this).next().css('color','#ff6700');
      pd3=true;
    }
  })
  // 移动电话
  $('.ppd').blur(function(){
    ppd = $(this).val();
    if(ppd==''){
      $(this).next().css('color','red');
      pd4=false;
    }else{
      $(this).next().css('color','#ff6700');
      pd4=true;
    }
  })

  // 多级联动地址

  // 提交表单
  $('#foadd').submit(function(){
    $('input').trigger('blur');
    if(pd1 && pd2 && pd3 && pd4){
      return true;
    }else{
      return false;
    }
  })
  </script>
@endsection