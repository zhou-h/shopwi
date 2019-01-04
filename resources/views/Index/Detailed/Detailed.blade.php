@if(session('success'))
<div class="success">
    <p  style="background:#E1F1C0;width100%;height:30px;text-align:center;line-height:30px;cursor: pointer;">发表成功</p>
</div> 
@endif
@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/show.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/Home/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<!--图片放大效果-->
<script src="/Home/js/jqzoom.js" type="text/javascript"></script>
@endsection
@section('main')
<!-- 添加成功与失败的jq -->
        <script>
            // 成功
            $('.success').click(function(){
                $(this).empty();
            })
            // 失败
            $('.error').click(function(){
                $(this).empty();
            })
        </script>
<!--产品详细页样式-->
<div class="clearfix Inside_pages">
<div class="Location_link">
  <em></em><a href="#">{{$types->name}}</a>  &lt;
 </div>
 <!--产品详细介绍样式-->
 <div class="clearfix" id="goodsInfo">
 <!--产品图片放大-->
   <div class="mod_picfold clearfix">
    <div class="clearfix" id="detail_main_img">
	 <div class="layout_wrap preview">
     <div id="vertical" class="bigImg">
		<img src="{{$goods->pic}}" width="" height="" alt="" id="midimg" />
		<div id="winSelector"></div>
	</div>
     <div class="smallImg">
		<div class="scrollbutton smallImgUp disabled">&lt;</div>
		<div id="imageMenu">
			<ul>
				<li><img src="{{$goods->pic}}" width="68" height="68" alt="洋妞"/></li>
			</ul>
		</div>
		<div class="scrollbutton smallImgDown">&gt;</div>
	</div><!--smallImg end-->	
	<div id="bigView" style="display:none;"><div><img width="800" height="800" alt="" src="{{$goods->pic}}" /></div></div>
	 </div>
	</div>
		 <div class="Sharing">
	 <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1441079683326"><a href="#" class="bds_more" data-cmd="more">分享到：</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
  <!--收藏-->
	  <div class="Collect"><a href="javascript:collect(92)" class="sc">
       @if($collect)
       <em class="iconfont icon-shoucang1" id="{{$goods->id}}" style="color:red"></em>收藏商品( 2345 )</a>
       @else
            <em class="iconfont icon-shoucang" id="{{$goods->id}}"></em> 收藏商品( 2345 )</a>
        @endif
       </div>
       <script>
        $('.sc').click(function(){
          id=$(this).find('em').attr('id');
          // alert(id);
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
                alert('取消收藏');
              }else{
                alert('操作失败');
              }
            });
          }
          // alert(dd);
        });
    </script>
	 </div>
   </div>
    <!--产品信息-->
    <div class="property">
     <form action="javascript:addToCart(97)" name="ECS_FORMBUY" id="ECS_FORMBUY">
       <h2>{{$goods->name}} {{$goods->descr}}</h2>
       <div class="goods_info">{{$goods->descr}}</div>
       <div class="ProductD clearfix">
       <div class="productDL">       
        <dl><dt>售&nbsp;&nbsp;价：</dt><dd><span id="ECS_SHOPPRICE"><i>￥</i>{{$goods->price}}</span><del>市场价：￥{{$goods->price}}</del></dd> </dl>
        <dl><dt>总 重 量：</dt><dd>140克</dd> </dl>
        <dl>
          <dt>规&nbsp;&nbsp;格：</dt>
          <dd>
          @if(count($goodsize))
            @foreach($goodsize as $v)
                    <div class="item "><b></b><a href="javascritp:void(0)" id="{{$goods->id}}" onclick="myfunc({{$v->id}},this)" title="小礼盒">{{$v->color}}</a></div> 
            @endforeach
          @else
            <h3 style="color:red;">此商品没有库存,抱歉!</h3>
          @endif
          </dd>
        </dl>
        <dl><dt>上架时间：</dt><dd>{{$goods->updated_at}}</dd></dl>
        <div class="Appraisal"><p>销售评价</p><a>{{$goods->sales}}</a> </div>
       </div>
      </div>
      <div class="buyinfo" id="detail_buyinfo">
    <dl>
        <dt>数量</dt>
        <dd>
      <div class="choose-amount left">
      <a class="btn-reduce" href="javascript:void(0);" onclick="jian('-')">-</a>
      <a class="btn-add" href="javascript:void(0);" onclick="jian('+')">+</a>
      <input class="text" id="buy-num" value="1" onkeyup="setAmount.modify('#buy-num');">   
     </div>
     <div class="P_Quantity">剩余：<span id='ba' style="color:red"></span>件</div>        
        </dd>
    <dd>
      <div class="wrap_btn"> <a href="javascript:void(0)" onclick="jumurl()" class="wrap_btn1" title="加入购物车"></a> 
      <a href="javascript:addToCart(92)" onclick="jumurl()" class="wrap_btn2" title="立即购买"></a> </div>
      </dd>
    </dl>
    </div>
      <script>
            function myfunc(id,obj){
                ids=id;
                goodid=$(obj).attr('id');
                nums=1;
                // alert(id);
                // dd=$(this).html();
                if(!$(obj).parents('div').hasClass('selected')){
                    $(obj).parents('div').siblings('div').removeClass('selected')
                    $(obj).parents('div').addClass('selected');
                    $.get('/getdetail',{'id':id},function(data){
                        // alert(data);
                        $('#ba').html(data['store']);
                    },'json');
                }else{
                    $(obj).parents('div').removeClass('selected');
                }   
            }
            function jian(yo){
                    num=parseInt($('#ba').html());
                    dd=eval(parseInt($('#buy-num').val())+yo+1);
                    if(dd==0){
                        dd=1;
                    }
                    if(dd>num){
                        dd=num;
                    }
                    nums=dd;
                    $('#buy-num').val(dd);
                
            }

            function jumurl(){
              if(ids && goodid){
              　　window.location.href = 'http://www.wiki.com/sessionadd/'+ids+'/'+goodid+'/'+nums;
              }else{
                  alert('请选择商品规格！');
              }
          　　}
      </script>
      <div class="Guarantee clearfix">
     <dl><dt>支付方式</dt><dd><em></em>货到付款（部分地区）</dd><dd><em></em>在线支付</dd> 
     <dd> <div class="payment" id="payment"> 
       <a href="javascript:void(0);" class="paybtn">支付方式<span class="iconDetail"></span></a><ul><li>货到付款</li><li>礼品卡支付</li><li>网上支付</li><li>银行转账</li></ul>
       </div>
    </dd>
      </dl>
     </div>
     </form>
    </div>
    <!--推荐-->
    <div class="p_right_info">
    <div class="Brands">
     <a href="#"><img src="/Home/products/logo/logo.jpg"  width="120" height="60"/></a>
     <h5>红尊</h5>
    </div>
    <div class="Recommend">
      <div class="title_name">同类产品推荐</div>
    <div class="Recommend_list">
      <ul>
      @foreach($tgood as $value)
         <li class="clearfix ">
         <div class="pic_img "><a href="/detail/{{$value->id}}"><img src="{{$value->pic}}" data-bd-imgshare-binded="1"></a></div>
            <div class="r_content">
                <div class="title"><a href="/detail/{{$value->id}}">{{$value->name}} {{$value->descr}}</a></div>
                <div class="p_Price">￥{{$value->price}}</div>
            </div>
         </li>
        @endforeach
    </ul>
    </div>
   </div>
  </div>
 </div>
 <!--样式-->
  <div class="clearfix">
   <div class="left_style">
    <div class="user_Records">
     <div class="title_name">用户浏览记录</div>
   <ul>
     @foreach($tgood as $value)
    <li>
     <a href="/detail/{{$value->id}}">
     <p><img src="{{$value->pic}}" data-bd-imgshare-binded="1"></p>
     <p class="p_name">S{{$value->name}} {{$value->descr}}</p>
     </a>
     <p><span class="p_Price"><i>￥</i>{{$value->price}}</span></p>
    </li>
    @endforeach
   </ul>
   </div>
   </div>
   <!--介绍信息样式--> 
   <div class="right_style">	  
		<div class="inDetail_boxOut ">
	 <div class="inDetail_box">
	  <div class="fixed_out ">
	   <ul class="inLeft_btn fixed_bar">
                  <li class="active"><a id="property-id" href="#shangpsx" class="current">规格与包装</a></li>
                  <li><a id="detail-id" href="#shangpjs">商品属性</a></li>
                  <li><a id="shot-id" href="#miqsp">售后服务</a></li>
                  <li><a id="coms1-id" href="#status2">买家评论({{count($judgelist['judgeall'])}})</a></li>
                </ul>
               <div class="subbuy">
          <span class="extra currentPrice"> ¥129.90</span>
          <a href="#" class="extra  notice J_BuyButtonSub">立即购买</a></div>
	  </div>
	 </div>	  
	</div> 
     <div id="shangpjs" class="info_style" style="text-align:center"><img src="{{$goods->pic}}" width="600px" /></div>
    <div class="productContent" id="status2">
      <div class="iComment clearfix">
        <div class="rate"><strong id="goodRate">
        @if(count($judgelist['judgegood'])>0)
            {{floor(count($judgelist['judgegood'])/count($judgelist['judgeall'])*100) }}
        @else
            0
        @endif
        <span>%</span></strong><br>
          <span>好评度</span></div>
        <div class="percent" id="percentRate">
          <dl>
            <dt>好评<span>(<i id="haofen">
            @if(count($judgelist['judgegood'])>0)
                {{floor(count($judgelist['judgegood'])/count($judgelist['judgeall'])*100)}}%
            @else
                0
            @endif
            </i>)</span></dt>
            <dd>
              <div style="width:100px;" id="goodwool"></div>
            </dd>
          </dl>
          <dl>
            <dt>一般<span>(<i id="yifen">
            @if(count($judgelist['judgeordinary'])>0)
                {{floor(count($judgelist['judgeordinary'])/count($judgelist['judgeall'])*100)}}%
            @else
                0
            @endif
            </i>)</span></dt>
            <dd class="d1">
              <div style="width:100px;" id="ordinarywool"> </div>
            </dd>
          </dl>
          <dl>
            <dt>差评<span>(<i id="chafen">
            @if(count($judgelist['judgebad'])>0)
                {{floor(count($judgelist['judgebad'])/count($judgelist['judgeall'])*100)}}%
            @else
                0
            @endif
            </i>)</span></dt>
            <dd class="d1">
              <div style="width:100px;" id="badwool"> </div>
            </dd>
          </dl>
        </div>
        <!-- 评价分数线的js -->
        <script>
            // 好评分数线
            $('#goodwool').css('backgroundColor','#EFEFEF');
            haofen = $('#haofen').html();
            long1 = 100*(parseInt(haofen)/100);
            div = $('<div style="width:'+long1+'px'+';height:10px;background:#ff6700"></div>');
            $('#goodwool').append(div);
            // 一般分数线
            $('#ordinarywool').css('backgroundColor','#EFEFEF');
            yifen = $('#yifen').html();
            long2 = 100*(parseInt(yifen)/100);
            div2 = $('<div style="width:'+long2+'px'+';height:10px;background:#ff6700"></div>');
            $('#ordinarywool').append(div2);
            // 差评分数线
            $('#badwool').css('backgroundColor','#EFEFEF');
            chafen = $('#chafen').html();
            long3 = 100*(parseInt(chafen)/100);
            div3 = $('<div style="width:'+long3+'px'+';height:10px;background:#ff6700"></div>');
            $('#badwool').append(div3);
        </script>
        <div class="actor">
          <dl>
            <dt>发表评价即可获得10积分，精华评论更有 <font color="red">额外奖励</font> 积分；<br>
              还有7个多倍积分名额哦，赶紧抢占吧！<br>
              只有购买过该商品的用户才能进行评价。</dt>
            <dd>
            <!-- @if(session('buyok')) -->
              <input type="submit" class="Publication_btn" onclick="send_cooment()" value="发表评论">
           
            <!-- @endif -->
            </dd>
          </dl>
        </div>
      </div>
	  <div class="commentBox" style="display:none;">
		<form action="/indexjudge" method="post" name="commentForm" id="commentForm">
		  <h3>商品评分</h3>
		  <div id="star">
			<ul>
                <label for="grade0">
			        <li onclick="dorank(0)">
                        <span id="fenshu0"></span>
    				    <p>0分</p>
    				    <p>不满意</p>
			        </li>
                </label>
              <input type="radio" name="status" value="0"  id="grade0" style="display:none" />

			  <label for="grade1">
                    <li onclick="dorank(1)">
                        <span id="fenshu1"></span>
                        <p>1分</p>
                        <p>一般</p>
                    </li>
                </label>
              <input type="radio" name="status" value="1"  id="grade1" style="display:none" />
              
               <label for="grade2">
                    <li onclick="dorank(2)">
                        <span id="fenshu2"></span>
                        <p>2分</p>
                        <p>满意</p>
                    </li>
                </label>
              <input type="radio" name="status" value="2"  id="grade2" style="display:none" />
			</ul>
			
		  </div>
            <!-- 商品评分js -->
            <script>
                function dorank(rank_id){
                    // alert(rank_id)
                    if (rank_id==0) {
                        // 所有星星都变暗
                        $('#star ul label li span').css('background-image','url(/Home/images/bg_star1.png)');
                        // 选中的星星那边亮
                        $('#fenshu0').css('background-image','url(/Home/images/bg_star2.png)');
                    }
                    if (rank_id==1) {
                        $('#star ul label li span').css('background-image','url(/Home/images/bg_star1.png)');
                        $('#fenshu1').css('background-image','url(/Home/images/bg_star2.png)');
                    }
                    if (rank_id==2) {
                        $('#star ul label li span').css('background-image','url(/Home/images/bg_star1.png)');
                        $('#fenshu2').css('background-image','url(/Home/images/bg_star2.png)');
                    }
                }
            </script>
		  <h4>评论内容</h4>
		  <div class="bd">
			<textarea name="judge" id="content" class="textarea_long" onkeyup="checkLength(this);" required></textarea>
			<p class="g">
			  <label>&nbsp; </label>
              {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{session('id')}}">
                <input type="hidden" name="goods_id" value="{{$id}}">
                <input type="submit" value="发表" class="btn_common">
			  <span t="word_calc" class="word"><b id="sy">0</b>/1000</span> </p>
		  </div>
		</form>
		</div>
		<div id="ECS_COMMENT"> <div class="Comment">
        
<div class="CommentTab">
  <ul>
	<li class="active" onclick="checkjudge(0)" id="alljudge">全部评论(<b>{{count($judgelist['judgeall'])}}</b>)</li>
	<li onclick="checkjudge(1)" id="goodjude">好评(<b>{{count($judgelist['judgegood'])}}</b>)</li>
	<li onclick="checkjudge(2)" id="ordinaryjudge">一般(<b>{{count($judgelist['judgeordinary'])}}</b>)</li>
	<li onclick="checkjudge(3)" id="badjudge">差评(<b>{{count($judgelist['judgebad'])}}</b>)</li>
  </ul>
</div>
<div class="CommentText" id="goodsdetail_comments_list" style="display:block">
    <div id="goodsdetail_comments_list_content">
        <!-- 全部评论 -->
        <div style="display:block" id="goodsdetail_all">
            <br>
            @if(!$judgelist['judgeall'])
                <div style="width:100%;height:50px;text-align:center" class="meiyou">
                    <p>对不起。没有评论</p>
                </div>
            @endif
            @foreach($judgelist['judgeall'] as $alljudge)
            <div style="border:1px solid white;float:left" class="a1">
                <img src="{{$alljudge->pic}}" width="50px" height="50px" >
                <p style="margin-left:10px;">{{$alljudge->username}}</p>
            </div>
            <div style="float:left;margin-left:20px;" class="a1">
                <p>{{$alljudge->judge}}</p><br>
                <p>{{$alljudge->addtime}}</p>
            </div>
            <div style="clear:both;border-top:1px solid #ccc;" class="a1"></div><br>
            @endforeach
            
        </div>
        <!-- 好评 -->
        <div style="display:none" id="goodsdetail_good">
            <br>
            @if(!$judgelist['judgegood'])
                <div style="width:100%;height:50px;text-align:center" class="meiyou">
                    <p>对不起。没有评论</p>
                </div>
            @endif
            @foreach($judgelist['judgegood'] as $alljudge)
            <div style="border:1px solid white;float:left" class="a2">
                <img src="{{$alljudge->pic}}" width="50px" height="50px" >
                <p style="margin-left:10px;">{{$alljudge->username}}</p>
            </div>
            <div style="float:left;margin-left:20px;" class="a2">
                <p>{{$alljudge->judge}}</p><br>
                <p>{{$alljudge->addtime}}</p>
            </div>
            <div style="clear:both;border-top:1px solid #ccc;" class="a2"></div><br>
            @endforeach
        </div>
        <!-- 一般 -->
        <div id="goodsdetail_ordinary" style="display:none">
            <br>
            @if(!$judgelist['judgeordinary'])
                <div style="width:100%;height:50px;text-align:center" class="meiyou">
                    <p>对不起。没有评论</p>
                </div>
            @endif
            @foreach($judgelist['judgeordinary'] as $alljudge)
            <div style="border:1px solid white;float:left"  class="a3">
                <img src="{{$alljudge->pic}}" width="50px" height="50px" >
                <p style="margin-left:10px;">{{$alljudge->username}}</p>
            </div>
            <div style="float:left;margin-left:20px;" class="a3">
                <p>{{$alljudge->judge}}</p><br>
                <p>{{$alljudge->addtime}}</p>
            </div>
            <div style="clear:both;border-top:1px solid #ccc;" class="a3"></div><br>
            @endforeach
        </div>
        <!-- 差评 -->
        <div id="goodsdetail_bad" style="display:none">
            <br>
            @if(!$judgelist['judgebad'])
                <div style="width:100%;height:50px;text-align:center" class="meiyou">
                    <p>对不起。没有评论</p>
                </div>
            @endif
            @foreach($judgelist['judgebad'] as $alljudge)
            <div style="border:1px solid white;float:left"  class="a4">
                <img src="{{$alljudge->pic}}" width="50px" height="50px" >
                <p style="margin-left:10px;">{{$alljudge->username}}</p>
            </div>
            <div style="float:left;margin-left:20px;" class="a4">
                <p>{{$alljudge->judge}}</p><br>
                <p>{{$alljudge->addtime}}</p>
            </div>
            <div style="clear:both;border-top:1px solid #ccc;" class="a4"></div><br>
            @endforeach
        </div>
    </div>
    <!-- 评论的js -->
    <script>
    function checkjudge(id){
        // 全部评论的样式和显示与隐藏
        if (id==0) {
            $('.CommentTab ul li').removeClass('active');
            $('#alljudge').addClass('active');
            $('#goodsdetail_comments_list_content div').css('display','none');
            $('#goodsdetail_all').css('display','block');
            $('.a1').css('display','block');
            // 显示没有评论的样式
            $('.meiyou').css('display','block');
            $('.comment_Number span b').html($('#alljudge b').html());
        }
        
        // 好评的样式和显示与隐藏
        if (id==1) {
            $('.CommentTab ul li').removeClass('active');
            $('#goodjude').addClass('active');
            $('#goodsdetail_comments_list_content div').css('display','none');
            $('#goodsdetail_good').css('display','block');
            $('.a2').css('display','block');
            $('.meiyou').css('display','block');
            $('.comment_Number span b').html($('#goodjude b').html());
        }
        // 一般的样式和显示与隐藏
        if (id==2) {
            $('.CommentTab ul li').removeClass('active');
            $('#ordinaryjudge').addClass('active');
            $('#goodsdetail_comments_list_content div').css('display','none');
            $('#goodsdetail_ordinary').css('display','block');
            $('.a3').css('display','block');
            $('.meiyou').css('display','block');
            $('.comment_Number span b').html($('#ordinaryjudge b').html());
        }
        // 差评的样式和显示与隐藏
        if (id==3) {
            $('.CommentTab ul li').removeClass('active');
            $('#badjudge').addClass('active');
            $('#goodsdetail_comments_list_content div').css('display','none');
            $('#goodsdetail_bad').css('display','block');
            $('.a4').css('display','block');
            $('.meiyou').css('display','block');
            $('.comment_Number span b').html($('#badjudge b').html());
        }
    }

    </script>
  <ul class="clearfix">
	  </ul>
  <div class="comment_page clearfix">
	<div class="comment_Number"> <span class="f_l f6" style="margin-right:10px;">共 <b>{{count($judgelist['judgeall'])}}</b> 条评论</span>
	  <div id="comment_Pager_Number" class="comment_Pager_Number"> 
	    
      </div>
	</div>
  </div>
</div>
</div>
<script language="javascript">
function updatenum(type){
    var qty = parseInt(document.forms['ECS_FORMBUY'].elements['number'].value);
    if(type == 'del'){
        if(qty > 1){
            document.forms['ECS_FORMBUY'].elements['number'].value = (qty - 1);
        }
    }else{
        document.forms['ECS_FORMBUY'].elements['number'].value = (qty + 1);
    }
    //changePrice();
}

function send_cooment(){
    $(".commentBox").toggle();
}
function checkLength(which) {
    var maxChars = 1000; //
    if(which.value.length > maxChars){
        alert("您出入的字数超多限制!");
        which.value = which.value.substring(0,maxChars);
        return false;
    }else{
        var curr = maxChars - which.value.length; //250 减去 当前输入的
        document.getElementById("sy").innerHTML = curr.toString();
        return true;
    }
}
</script>
@endsection
@section('title','产品详细页')
</script>
</div>
    </div>
   </div>
  </div>
</div>
