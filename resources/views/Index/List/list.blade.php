@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/Home/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<script src="/Home/js/lrtk.js" type="text/javascript"></script>
@endsection
@section('main')
<script type="text/javascript" charset="UTF-8">
<!--
 //点击效果start
 function infonav_more_down(index)
 {
  var inHeight = ($("div[class='p_f_name infonav_hidden']").eq(index).find('p').length)*30;//先设置了P的高度，然后计算所有P的高度
  if(inHeight > 60){
   $("div[class='p_f_name infonav_hidden']").eq(index).animate({height:inHeight});
   $(".infonav_more").eq(index).replaceWith('<p class="infonav_more"><a class="more"  onclick="infonav_more_up('+index+');return false;" href="javascript:">收起<em class="pulldown"></em></a></p>');
  }else{
   return false;
  }
 }
 function infonav_more_up(index)
 {
  var infonav_height = 85;
  $("div[class='p_f_name infonav_hidden']").eq(index).animate({height:infonav_height});
  $(".infonav_more").eq(index).replaceWith('<p class="infonav_more"> <a class="more" onclick="infonav_more_down('+index+');return false;" href="javascript:">更多<em class="pullup"></em></a></p>');
 }
   
 function onclick(event) {
  info_more_down();
 return false;
 }
 //点击效果end  
//-->
</script>
<!--产品列表样式-->
<div class="Inside_pages clearfix">
 <!--位置-->
  <div class="Location_link">
  <em></em>
  <a href="#">{{$typename[0]}}</a>  
 </div>
    <!--筛选样式-->
   <div id="Filter_style">
     <!--推荐-->
    <div class="page_recommend">
      <div class="hd"><em></em>今日推荐<ul></ul></div>
      <div class="bd">
       <ul>
       @foreach($goods as $v)
        <li>
         <div class="img"><a href="/detail/{{$v->id}}"><img src="{{$v->pic}}" width="120" height="120" /></a></div>
         <div class="pro_info">
          <a href="/detail/{{$v->id}}">{{$v->name}}</a>
          <p class="Price"><i>￥</i>{{$v->price}}</p>
          <p class="Sales">热销：<b>{{$v->sales}}</b>件</p>
         </div>
        </li>
        @endforeach
       </ul>
      </div>
      <a class="next" href="javascript:void(0)"><em class="iconfont icon-left"></em></a>
      <a class="prev" href="javascript:void(0)"><em class="iconfont icon-right"></em></a>
    </div>
    <script type="text/javascript">
		jQuery(".page_recommend").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:4,trigger:"click"});
		</script>
   <!--条件筛选样式-->
     <div class="Filter">
  <div class="Filter_list clearfix">
   <div class="Filter_title"><span>品牌：</span></div>
   <div class="Filter_Entire"><a href="#">全部</a></div>
   <div class="p_f_name infonav_hidden">
    <p><a href="#" title="莱家/Loacker">莱家/Loacker </a>  
	<a href="#" title="">丽芝士/Richeese</a>  
	<a href="#" title="白色恋人/SHIROI KOIBITO ">白色恋人/SHIROI KOIBITO </a> 
	<a href="#">爱时乐/Astick </a> 
	<a href="#">利葡/LiPO </a> 
	<a href="#">友谊牌/Tipo </a> 
	<a href="#"> 三立/SANRITSU  </a>  
	<a href="#"> 皇冠/Danisa </a>  </p>
	 <p><a href="#">丹麦蓝罐/Kjeldsens</a>
	<a href="#">茱莉/Julie's </a>  
	<a href="#">向日葵/Sunflower </a>  
	<a href="#">福多/fudo </a> 
	<a href="#">非凡农庄/PEPPER...  </a>
	<a href="#">凯尔森/Kelsen </a> 
	<a href="#"> 蜜兰诺/Milano </a> 
	<a href="#">壹格/EgE  </a>  </p>
	 <p><a href="#">沃尔克斯/Walkers </a> 
	<a href="#">澳门永辉/MACAU...</a>  
    <a href="#" title="莱家/Loacker">莱家/Loacker </a>  
	<a href="#" title="">丽芝士/Richeese</a>  
	<a href="#" title="白色恋人/SHIROI KOIBITO ">白色恋人/SHIROI KOIBITO </a> 
	<a href="#">爱时乐/Astick </a> 
	<a href="#">利葡/LiPO </a> 
	<a href="#">友谊牌/Tipo </a>  </p>
	 <p><a href="#"> 三立/SANRITSU  </a>  
	<a href="#"> 皇冠/Danisa </a>  
	<a href="#">丹麦蓝罐/Kjeldsens</a>
	<a href="#">茱莉/Julie's </a>  
	<a href="#">向日葵/Sunflower </a>  
	<a href="#">福多/fudo </a> 
	<a href="#">非凡农庄/PEPPER...  </a>
	<a href="#">凯尔森/Kelsen </a>  </p>
	 <p><a href="#"> 蜜兰诺/Milano </a> 
	<a href="#">壹格/EgE  </a>  
	<a href="#">沃尔克斯/Walkers </a> 
	<a href="#">澳门永辉/MACAU...</a>  
       <a href="#" title="莱家/Loacker">莱家/Loacker </a>  
	<a href="#" title="">丽芝士/Richeese</a>  
	<a href="#" title="白色恋人/SHIROI KOIBITO ">白色恋人/SHIROI KOIBITO </a> 
	<a href="#">爱时乐/Astick </a>  </p>
	
   </div>
   <p class="infonav_more"><a href="#" class="more" onclick="infonav_more_down(0);return false;">更多<em class="pullup"></em></a></p>
  </div>
  <div class="Filter_list clearfix">
  <div class="Filter_title"><span>产地：</span></div>
  <div class="Filter_Entire"><a href="#">全部</a></div>
  <div class="p_f_name">
   <a href="#">中国大陆</a>     
   <a href="#">中国台湾</a>     
   <a href="#">中国香港</a>     
   <a href="#">中国澳门</a>     
   <a href="#">日本</a>     
   <a href="#">韩国</a>     
   <a href="#">越南</a>    
   <a href="#">泰国</a>
  </div>
  </div>
  <div class="Filter_list clearfix">
  <div class="Filter_title"><span>包装方式：</span></div>
  <div class="Filter_Entire"><a href="#">全部</a></div>
  <div class="p_f_name">
  <a href="#">袋装</a><a href="#">盒装</a><a href="#">罐装</a><a href="#">礼盒装</a><a href="#">散装(称重)</a>
  </div>
  </div>
  <div class="Filter_list clearfix">
  <div class="Filter_title"><span>价格：</span></div>
  <div class="Filter_Entire"><a href="#">全部</a></div>
  <div class="p_f_name">
    <a href="/list/50">0-50</a><a href="/list/150">50-150</a><a href="/list/500">150-500</a><a href="/list/1000">500-1000</a><a href="/list/1001">1000以上</a>
  </div>
  </div>
 </div>
 </div>
 <!--样式-->
   <div  class="scrollsidebar side_green clearfix" id="scrollsidebar"> 
     <div class="show_btn" id="rightArrow"><span></span></div>
     <!--左侧样式-->
   <div class="page_left_style side_content"  >
  <!--浏览记录-->
   <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
   <div class=" side_list">
   <div class="Record">
     <div class="title_name">浏览记录</div>
	 <ul>
    @foreach($goods as $v)
  	  <li>
  	   <a href="/detail/{{$v->id}}">
  	   <p><img src="{{$v->pic}}"></p>
  	   <p class="p_name">{{$v->name}}</p>
  	   </a>
  	   <p><span class="p_Price left">价格:<b>￥{{$v->price}}</b></span><span class="p_Sales right">销量：{{$v->sales}}件</span></p>
  	  </li>
    @endforeach
	 </ul>
   </div>
   <!--销售排行-->
    <div class="pro_ranking">
    <div class="title_name"><em></em>销量排行</div>
    <div class="ranking_list">
     <ul id="tabRank">
      @foreach($goodtop as $value)
        <li class="t_p on">
        <em class="icon_ranking">{{$i++}}</em>
        <dt><h3><a href="/detail/{{$value->id}}">{{$value->name}}</a></h3></dt>
        <dd class="clearfix">
        <a href="/detail/{{$value->id}}"><img src="{{$value->pic}}" width="90" height="90" /></a>
        <span class="Price">￥{{$value->price}}</span>
        </dd>     
        </li>
      @endforeach
     </ul>
    </div>
    </div>
    <script type="text/javascript">
	jQuery("#tabRank li").hover(function(){ jQuery(this).addClass("on").siblings().removeClass("on")},function(){ });
    jQuery("#tabRank").slide({ titCell:"dt h3",autoPlay:false,effect:"left",delayTime:300 });
    </script>
    </div>
 </div>
  <script type="text/javascript"> 
$(function() { 
	$("#scrollsidebar").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime : 600
	});
});
</script>
 <!--列表样式属性-->
  <div class="page_right_style">
    <div id="Sorted" >
 <div class="Sorted">
  <div class="Sorted_style">
   <a href="/getfunc/{{$typeid}}-order" class="on">综合<i class="iconfont icon-fold"></i></a>
   <a href="/getfunc/{{$typeid}}-sales" class="ali" onclick="func('sales',this)">销量<i class="iconfont icon-fold"></i></a>
   <a href="/getfunc/{{$typeid}}-price" class="ali" onclick="func('price',this)">价格<i class="iconfont icon-fold"></i></a>
   <!-- <a href="/getfunc/{{$typeid}}-updated_at" class="ali" onclick="func('updated_up',this)">新品<i class="iconfont icon-fold"></i></a> -->
   </div>

   <!--产品搜索-->
   <div class="products_search">
    <input name="" type="text" class="search_text" value="请输入你要搜索的产品" onfocus="this.value=''" onblur="if(!value){value=defaultValue;}"><input name="" type="submit" value="" class="search_btn">
   </div>
   <!--页数-->
   <div class="s_Paging">
   <span> 1/12</span>
   <a href="#" class="on">&lt;</a>
   <a href="#">&gt;</a>
   </div>
   </div>
   </div>
   <!--产品列表样式-->
 <div class="p_list  clearfix">
   <ul id="hhh">
   @foreach($goodz as $v)
    <li class="gl-item">
       <em class="icon_special tejia"></em>
    	 <div class="Borders">
    	 <div class="img">
            <a href="/detail/{{$v->gid}}">
                <img src="{{$v->pic}}" style="width:220px;height:220px">
            </a>
       </div>
    	 <div class="Price"><b>¥{{$v->price}}</b><span>[¥49.01/500g]</span></div>
    	 <div class="name"><a href="/detail/{{$v->gid}}">{{$v->gname}}</a></div>
       <div class="Review">已售<a href="#">{{$v->sales}}</a>件</div>
      	 <div class="p-operate">
            @if($v->collect)
            <a href="javascript:void(0)" class="p-o-btn coll" id="{{$v->gid}}"><em class="iconfont icon-shoucang1 "  style="color:red"></em> 收藏</a>
            @else
            <a href="javascript:void(0)" class="p-o-btn coll" id="{{$v->gid}}"><em class="iconfont icon-shoucang "  style="color:red"></em> 收藏</a>
            @endif
            <a href="#" class="p-o-btn shop_cart"><em></em>加入购物车</a>
         </div>
    	 </div>
	</li>
	@endforeach
   </ul>
   <script>
       $('.coll').click(function(){
          id=$(this).attr('id');
          // alert($(this).find('em').attr('class'));
          if($(this).find('em').attr('class')=='iconfont icon-shoucang'){
              $(this).find('em').removeClass('icon-shoucang').addClass('icon-shoucang1');
              $.get('/getCollect',{goods_id:id},function(data){
                  if(data){
                    alert('收藏成功');
                  }else{
                    alert('收藏失败');
                  }
              });
          }else{
              $(this).find('em').removeClass('icon-shoucang1').addClass('icon-shoucang');
              $.get('/outCollect',{goods_id:id},function(data){
                  if(data){
                    alert('已取消收藏');
                  }else{
                    alert('操作失败');
                  }
              });
            }
          // alert(dd);
        });
   </script>
   <div id="pages">{{$goodz->appends($request)->render()}}</div>
   </div>
  </div>
 </div>
</div>
<script>
      function func(name,obj){
          alert($(obj).html());
          $.get('/list',{'name':name},function(data){
              alert(data);
              
              }
          },'json');
      }
</script>
@endsection
@section('title','产品列表')