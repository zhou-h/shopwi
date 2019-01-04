@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/show.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
@endsection
@section('main')
<!--购物车样式-->
<div class="Inside_pages clearfix">
  <div class="shop_carts">
   <div class="Process"><img src="/Home/images/Process_img_01.png" /></div>
 <div class="Shopping_list">
  <div class="title_name">
    <ul>
	<li class="checkbox"></li>
	<li class="name">商品名称</li>
	<li class="scj">本店价(单位/元)</li>
	<li class="bdj">库存</li>
	<li class="sl">购买数量</li>
	<li class="xj">小计(单位/元)</li>
	<LI class="cz">操作</LI>
  </ul>
 </div>
  <div class="shopping">
  <form  method="post" action="/indexorder" id="form">
 <table class="table_list">
      @if(empty($data))
      <a href="/"><img src="/Home/images/shop_cart.jpg" width="1200px" height="306px"></a>
      @else
      @foreach($data as $row)
       <tr class="tr on">
       <td class="checkbox"></td>
      <td class="name">
        <div class="img"><a href="#"><img src="{{$row['pic']}}" /></a></div>
        <div class="p_name"><a href="#">{{$row['name']}}&nbsp;{{$row['descr']}}&nbsp;{{$row['color']}}</a></div>
      </td>
      <td class="scj sp price" id="p{{$row['id']}}">{{$row['price']}}</td>
      <td class="bgj sp" id="sto{{$row['id']}}">{{$row['store']}}</td>
      <td class="sl">
          <div class="Numbers">
            <!-- <a href="javascript:void(0)" class="jian" onclick="jian({{$row['id']}})">-</a> -->
            <a href="/shopcartjian/{{$row['id']}}" class="jian" onclick="jian({{$row['id']}})">-</a>

            <input type="text" name="qty_item_" value="{{$row['num']}}" id="k{{$row['id']}}" onkeyup="setAmount.modify('#qty_item_')" class="number_text">
            <a href="/shopcartjia/{{$row['id']}}" class="jia" onclick="jia({{$row['id']}})" >+</a>
           </div>
      </td>
      <td class="xj subtotal" id="s{{$row['id']}}"><span>{{$row['tot']}}</span></td>
      <td class="cz">
       <p><a href="javascript:void(0)" id="del{{$row['id']}}" onclick="del({{$row['id']}})">删除</a></p>
       <p><a href="#">收藏该商品</a></p>
      </td>
    </tr>
     @endforeach
     @endif
 </table>
 <div class="sp_Operation clearfix">
  <div class="select-all">
  <!-- <div class="cart-checkbox"><input type="checkbox"   id="CheckedAll" name="toggle-checkboxes" class="jdcheckbox" clstag="clickcart">全选/全不选</div> -->
  <!-- <div class="operation"><a href="javascript:void(0);" id="send">删除选中的商品</tr></a></div>  -->
    </div>    
	 <!--结算-->
	<div class="toolbar_right">
    <ul class="Price_Info">
    <li class="p_Total"><label class="text">商品总价：</label><span class="price sumPrice" id="total">
      @if(empty($data))
        0
      @else
        {{$total}}
      @endif
    </span></li>
	<li class="Discount"><label class="text">以&nbsp;&nbsp;节&nbsp;&nbsp;省：</label><span class="price" id="Preferential_price"></span></li>
    <li class="integral">本次购物可获得<b id="total_points"></b>积分</li>
    </ul>
	<div class="btn">
    {{csrf_field()}}
    @if(empty($data))
      <h2>购物车没有商品,<a href="/">去购物</h2></a>
    @else
    <input class="cartsubmit" type="submit" ses="{{session('id')}}" ></a>
    <input class="continueFind"  /></div>
    @endif
  </div>
  </div>
   </form>
 </div>
 </div>
 <!--推荐产品样式-->
 <div class="recommend_shop">
   <div class="title_name">推荐购买</div>
   <div class="recommend_list">
    <div class="hd">
     <a class="prev" href="javascript:void(0)">&gt;</a>
     <a class="next" href="javascript:void(0)">&lt;</a>
    </div>
    <div class="bd">
      <ul>
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_45.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_5.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_36.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_25.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
       
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_15.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
       <li class="recommend_info">
       <a href="#" class="buy_btn">立即购买</a>
       <a href="#" class="img"><img src="/Home/products/p_37.jpg" width="160px" height="160px"/></a>
       <a href="#" class="name">光明莫斯利安酸牛奶 巴氏杀菌常温200g*12盒钻石装</a>
       <h4><span class="Price"><i>RNB</i>123.00</span></h4>
       </li>
      </ul>  
    </div>
   </div>
   <script>jQuery(".recommend_list").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:6});</script>
 </div>
 </div>
</div>
<script type="text/javascript">

function del(a){
  // 获取商品的id
  id=a;
  // alert(id);
  $.get('/shopcartdelone',{id:id},function(data){
    // alert(data);
    if(data==1){
      $('#del'+a).parents('tr').remove();
    }
  },'json');
}
var nn = false;
$('.cartsubmit').click(function(){
  str = $(this).attr('ses');
  // alert(str);
  if(str==''){
    alert('请先登录');
     nn =false;
  }else{
    nn = true;
  }
})
 

$('#form').submit(function(){
 if(nn){
  return true;
 }else{
  return false;
 }
})
/*function jia(b){
  // 获取商品id
  id=b;
  $.get('/shopcartadd',{id:id},function(data){
    alert(data);
  });
}*/




</script>
 @endsection
 @section('title','购物车')
