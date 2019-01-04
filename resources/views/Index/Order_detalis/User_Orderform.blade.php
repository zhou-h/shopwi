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
<style type="text/css">
  .del:hover{
    color: #d9534f;
    cursor: pointer;
  }
</style>
@endsection
@section('main')
<!--订单详情管理-->
<!--订单管理-->
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
   <div class="right_style">
     <div class="info_content">   
      <div class="title_Section"><span>订单管理</span></div>
      <div class="Order_form_list">
         <table>
         <thead>
          <tr><td class="list_name_title0">商品</td>
          <td class="list_name_title1">单价(元)</td>
          <td class="list_name_title2">数量</td>
          <td class="list_name_title4">实付款(元)</td>
          <td class="list_name_title5">订单状态</td>
          <td class="list_name_title6">操作</td>
         </tr></thead> 
         @foreach($data as $v)
         <tbody class="tbody">       
           <tr class="Order_info"><td colspan="6" class="Order_form_time">下单时间：{{$v->addtime}} | 订单号：{{$v->order_num}} <em></em></td></tr>
           <tr class="Order_Details">
           <td colspan="3">
           <table class="Order_product_style">
            
           <tbody><tr>
           <td>
            <div class="product_name clearfix">
            <a href="#" class="product_img"><img src="{{$v->pic}}" width="80px" height="80px"></a>
            <a href="3">{{$v->name}}</a>
            <p class="specification">{{$v->descr}}</p>
            </div>
            </td>
            <td>{{$v->price}}</td>
           <td>{{$v->num}}</td>
            </tr>
            </tbody>
            
          </table>
           </td>   
           <td class="split_line">{{$v->price*$v->num}}</td>
           <td class="split_line">
            @if($v->status==0)
                <span class="btn btn-group" style="border-radius: 5px;line-height: 20px;">待发货</span>
            @elseif($v->status==1)
                <a href="/paymoney/{{$v->id}}" class="btn-danger" style="border-radius: 5px;line-height: 20px;background-color: "#d9534f">已发货,请支付</a>
            @elseif($v->status==2)
                <span class="btn-success" style="border-radius: 5px;line-height: 20px;">已支付,请等待货物送达</span>
            @elseif($v->status==3)
                <a href="/indexorderstatus/{{$v->id}}/4" class="btn-success" style="border-radius: 5px;line-height: 20px;">货物送达,请确认收货</a>
            @elseif($v->status==4)
                <span class="btn-success" style="border-radius: 5px;line-height: 20px;">交易完成</span>
            @endif
           </td>
           <td class="operating">
                <a href="/orderinfo/{{$v->id}}">查看详细</a>
             <span onclick="delone({{$v->id}})" class="del" id="del{{$v->id}}">删除</span>
           </td>
           </tr>
           </tbody>  
          @endforeach     
         </table>
    </div>
      <script>jQuery(".Order_form_list").slide({titCell:".Order_info", targetCell:".Order_Details",defaultIndex:1,delayTime:300,trigger:"click",defaultPlay:false,returnDefault:false});</script>
     </div>  
      <div class="Paging">
    <div class="Pagination">
    <a href="#">首页</a>
     <a href="#" class="pn-prev disabled">&lt;上一页</a>
	 <a href="#" class="on">1</a>
	 <a href="#">2</a>
	 <a href="#">3</a>
	 <a href="#">4</a>
	 <a href="#">下一页&gt;</a>
	 <a href="#">尾页</a>	
     </div>
    </div>
     <!---->
     </div>    
   </div>
   </div>
   @endsection
   <script type="text/javascript">
    function delone(a){
      id=a;
      // console.log($('#del'+a).parents('.tbody'));
      // alert(id);   
      $.get('/delone',{id:id},function(data){
        if(data==1){
          $('#del'+a).parents('.tbody').remove();
          alert('删除订单记录成功');
        }else if(data==2){
          alert('删除订单记录失败');
        }else{
          alert('该订单记录现在不能删除,只能等交易完成,才能删除');
        }
      });
    }
   </script>
   @section('title','用户订单')
