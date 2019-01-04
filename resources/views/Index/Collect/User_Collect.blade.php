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
<!--用户收藏样式-->
<div class="user_style clearfix">
  <div class="user_center">
   <div class="left_style">
    <div class="menu_style">
     <div class="user_title">用户中心</div>
     <div class="user_Head">
     <div class="user_portrait">
      <a href="#" title="修改头像" class="btn_link"></a> <img src="/Home/images/people.png">
      <div class="background_img"></div>
      </div>
      <div class="user_name">
       <p><span class="name">化海天堂</span><a href="#">[修改密码]</a></p>
       <p>访问时间：2016-1-21 10:23</p>
       </div>           
     </div>
     <div class="sideMen">
     <!--菜单列表图层-->
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_1"></em>订单中心</dt>
      <dd>
        <ul>
          <li> <a href="user.php?act=order_list"> 我的订单</a></li>
          <li> <a href="User_address.html">收货地址</a></li>
          <li> <a href="user.php?act=booking_list"> 缺货登记</a></li>
        </ul>
      </dd>
    </dl>
     <dl class="accountSideOption1">
      <dt class="transaction_manage"><em class="icon_2"></em>会员中心</dt>
        <dd>
      <ul>
        <li> <a href="user.php?act=profile"> 用户信息</a></li>
        <li> <a href="User_Collect.html"> 我的收藏</a></li>
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
      <li> <a href="user.php?act=bonus">我的红包</a></li>
      <li><a href="user.php?act=group_buy">我的团购</a></li>
       <li> <a href="user.php?act=track_packages"> 跟踪包裹</a></li>
       <li> <a href="user.php?act=account_log"> 资金管理</a></li>
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
       <div class="collect_style r_user_style">
        <div class="title_Section"><span>用户收藏</span></div>
         <div class="collect">
              <ul class="Quantity"><li>已藏量：{{$sum}}条</li><li></li></ul>
          <div class="collect_list">
      <ul>
      @foreach($data as $v)
       <li class="collect_p">
         <em class="iconfont icon-close2 delete" id="{{$v->id}}"></em>
         <a href="/detail/{{$v->id}}" class="buy_btn">立即购买</a>
          <div class="collect_info">
            <div class="img_link"> <a href="/detail/{{$v->id}}" class="center "><img src="{{$v->pic}}"></a></div>
            <dl class="xinxi">
            <dt><a href="#" class="name">{{$v->name}}</a></dt>
            <dd><span class="Price"><b>￥</b>{{$v->price}}</span><span class="collect_Amount"><i class="iconfont icon-shoucang"></i></span></dd>      
            </dl>
          </div>
       </li>
      @endforeach
      </ul>
     </div>
     <div class="Paging">
    <div class="Pagination">
    {{$data->appends($request)->render()}}
     </div>
    </div>
      </div>
     </div>   
    </div>
    </div>
    <!---->
  </div>
</div>
<script>
  $('.delete').click(function(){
    // alert($);
    id=$(this).attr('id');
    li=$(this).parents('li');
    // alert(id);
    $.get('/outCollect',{goods_id:id},function(data){
      if(confirm('你确定删除吗?')){
        if(data){
            li.remove();
            // alert('已移除');
        }else{
            alert('操作失败');
        }
      }
        
    })
  });
</script>
@endsection
@section('title','用户收藏')
