<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('css')
@show
<title>@yield('title')</title>
</head>

<body>
<!-- 广告 -->
@if(isset($advertisement))
  <div id="advertisements" style="position:relative;display:overflow;" >
    <a href="{{$advertisement->url}}" target="_blank">
      <img src="{{$advertisement->content}}" style="width:100%;" id="gg">
    </a>
      <img src="/Home/images/input-checked-hui.png" id="cuo" style="width:16px;height:16px;position:absolute;right:5px;top:5px;cursor:pointer">
  </div>

@endif
<!-- 广告js -->
<script>
  $('#cuo').click(function(){
    // alert(11);
   num =100;
   timmer =setInterval(function(){
        num--;        
        $('#advertisements').css('height',num+'px');
        // $('#advertisement').css('top',top+'px');
        //如果判断是否超出内容如果超出内容清除定时器
        $('#gg').css('height',num+'px');
        if(num <=0){
          clearInterval(timmer);
          $('#cuo').remove();
        }
      },10);
  });

</script>
<!--顶部样式-->
 <div id="header_top">
  <div id="top">
    <div class="Inside_pages">
      <div class="Collection">下午好，欢迎光临锦宏颜！<em></em><a href="javascript:addFavorite()"><span class="glyphicon glyphicon-heart"></span> <b>加入收藏</b></a></div>
    <div class="hd_top_manu clearfix">
      <ul class="clearfix">
       <li class="hd_menu_tit zhuce" data-addclass="hd_menu_hover">欢迎光临本店！
        @if(session('usname'))
        <a href="/userinfo">{{session('usname')}}</a>
          <a href="/login">退出</a>
        @elseif(session('username'))
        <a href="/userinfo">{{session('username')}}</a>
          <a href="/login">退出</a>
          @else
        <a href="/login/create" class="red">[请登录]</a> 
        新用户<a href="/register/create" class="red">[免费注册]</a>
        @endif
       </li>
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">我的订单</a></li> 
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"> <a href="#">购物车</a> </li>
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="#">联系我们</a></li>
       <li class="hd_menu_tit list_name" data-addclass="hd_menu_hover"><a href="#" class="hd_menu">客户服务</a>
        <div class="hd_menu_list">
           <ul>
            <li><a href="#">常见问题</a></li>
            <li><a href="#">在线退换货</a></li>
            <li><a href="#">在线投诉</a></li>
            <li><a href="#">配送范围</a></li>
           </ul>
        </div>     
       </li>
       <li class="hd_menu_tit phone_c" data-addclass="hd_menu_hover"><a href="#" class="hd_menu "><em class="iconfont icon-shouji"></em>手机版</a>
        <div class="hd_menu_list erweima">
           <ul>
            <img src="/Home/images/erweima.jpg"  width="100px" height="100"/>
           </ul>
        </div>     
       </li>
        @if(session('id'))
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="/indexletter">站内信</a></li>
       @endif
       @if(session('buyok'))
       <li class="hd_menu_tit" data-addclass="hd_menu_hover"><a href="/indexcj">抽奖</a></li>
       @endif
      </ul>
    </div>
    </div>
  </div>
  <!--顶部样式1-->
  <div id="header"  class="header page_style">
  <div class="logo"><a href="/"><img src="/Home/images/logo.png" /></a></div>
  <!--结束图层-->
  <div class="Search">
    <form action="/getfunc/all-order" method="get">
        <p><input name="keywords" type="text"  class="text"/><input name="" type="submit" value="搜 索"  class="Search_btn"/></p>
    </form>
    <p class="Words">
    @foreach($goodon as $v)
        <a href="/detail/{{$v->id}}">{{$v->name}}</a>
    @endforeach
    </p>
</div>
 <!--购物车样式-->
 <div class="hd_Shopping_list" id="Shopping_list">
   <div class="s_cart"><em class="iconfont icon-cart2"></em><a href="/shopcart">我的购物车</a> <i class="ci-right">&gt;</i><i class="ci-count" id="shopping-amount">0</i></div>
 </div>
</div>
<!--菜单导航样式-->
<div id="Menu" class="clearfix">
<div class="index_style clearfix">
  <div id="allSortOuterbox" class="display">
    <div class="t_menu_img"></div>
    <div class="Category"><a href="#"><em></em>所有产品分类</a></div>
    <div class="hd_allsort_out_box_new">
   <!--左侧栏目开始-->
   <ul class="Menu_list">
   @foreach($type as $v) 
      <li class="name">
          <div class="Menu_name"><a href="/getfunc/{{$v->id}}-order" >{{$v->name}}</a> <span>&lt;</span></div>
          <div class="link_name">
              <p>
                  <a href="product_Detailed.html">茅台</a>  <a href="#">五粮液</a>  <a href="#">郎酒</a>  <a  href="#">剑南春</a>
              </p>
          </div>
          <div class="menv_Detail">
           <div class="cat_pannel clearfix">
             <div class="hd_sort_list">
             @if(count($v->dev))
                @foreach($v->dev as $info )
                  <dl class="clearfix" data-tpc="1">
                     <dt><a href="/getfunc/{{$info->id}}-order">{{$info->name}}<i>></i></a></dt>
                     @if(count($info->dev))
                        <dd>
                          @foreach($info->dev as $ali )
                            <a href="/getfunc/{{$ali->id}}-order">{{$ali->name}}</a>
                          @endforeach
                       </dd> 
                    @endif
                  </dl>
                @endforeach
              @endif
             </div><div class="Brands"> 
            </div>
            </div>
            <!--品牌-->     
          </div>     
    </li>
   @endforeach
  </ul> 
  </div>    
  </div>
  <script>$("#allSortOuterbox").slide({ titCell:".Menu_list li",mainCell:".menv_Detail",  });</script>
  <!--菜单栏-->
  <div class="Navigation" id="Navigation">
     <ul class="Navigation_name">
      <li><a href="/">首页</a></li>
        <li><a href="/getfunc/all-order">产品列表</a></li>
      <li><a href="Limit_buy.html">限时特卖</a><em class="hot_icon"></em></li>
      <li><a href="#">联系我们</a></li>
      <li><a href="#">鲜盟人才</a></li>
      <li><a href="#">鲜盟金融</a></li>
      <li><a href="#">鲜盟投资</a></li>
      <li><a href="#">鲜盟股票</a></li>
     </ul>       
    </div>
  <script>$("#Navigation").slide({titCell:".Navigation_name li"});</script> 
  </div>
</div>
</div>  
    @section("main")
    @show
  </div>
</div>  
  <div class="slogen">
  <div class="index_style">
    <ul class="wrap">
     <li>
      <a href="#"><img src="/Home/images/slogen_34.png" data-bd-imgshare-binded="1"></a>
      <b>安全保证</b>
      <span>多重保障机制 认证商城</span>
     </li>
     <li><a href="#"><img src="/Home/images/slogen_28.png" data-bd-imgshare-binded="2"></a>
      <b>正品保证</b>
      <span>正品行货 放心选购</span>
     </li>
     <li>
      <a href="#"><img src="/Home/images/slogen_30.png" data-bd-imgshare-binded="3"></a>
      <b>七天无理由退换</b>
      <span>七天无理由保障消费权益</span>
     </li>
      <li>
      <a href="#"><img src="/Home/images/slogen_31.png" data-bd-imgshare-binded="4"></a>
      <b>天天低价</b>
      <span>价格更低，质量更可靠</span>
     </li>
    </ul>
  </div>
 </div>
<!--底部图层-->
<div class="phone_style">
 <div class="index_style">
   <span class="phone_number"><em class="iconfont icon-dianhua"></em>400-4565-345</span><span class="phone_title">客服热线 7X24小时 贴心服务</span>
 </div>
</div>
<div class="footerbox clearfix">
  <div class="clearfix">
   <div class="">
    <dl>
     <dt>新手上路</dt>
     <dd><a href="#">售后流程</a></dd>
     <dd><a href="#">购物流程</a></dd>
     <dd><a href="#">订购方式</a> </dd>
     <dd><a href="#">隐私声明 </a></dd>
     <dd><a href="#">推荐分享说明 </a></dd>
    </dl>
    <dl>
     <dt>配送与支付</dt>
     <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
    </dl>
    <dl>
     <dt>售后保障</dt>
     <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
    </dl>
    <dl>
     <dt>支付方式</dt>
     <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
    </dl>   
    <dl>
     <dt>帮助中心</dt>
     <dd><a href="#">保险需求测试</a></dd>
     <dd><a href="#">专题及活动</a></dd>
     <dd><a href="#">挑选保险产品</a> </dd>
     <dd><a href="#">常见问题 </a></dd>
    </dl>      
   </div>
  </div>
 <div class="text_link">
   <p>
  <a href="#">关于我们</a>｜ <a href="#">公开信息披露</a>｜ <a href="#">加入我们</a>｜ <a href="#">联系我们</a>｜ <a href="#">版权声明</a>｜ <a href="#">隐私声明</a>｜ <a href="#">网站地图</a></p>
     <p>蜀ICP备11017033号 Copyright ©2011 成都福际生物技术有限公司 All Rights Reserved. Technical support:CDDGG Group</p>
  </div>
  </div>
   <!--右侧菜单栏购物车样式-->
<div class="fixedBox">
  <ul class="fixedBoxList">
      <li class="fixeBoxLi user"><a href="/userinfo"> <span class="fixeBoxSpan iconfont icon-yonghu"></span> <strong>用户</strong></a> </li>
    <li class="fixeBoxLi cart_bd" style="display:block;" id="cartboxs">
        <p class="good_cart">0</p>
            <span class="fixeBoxSpan iconfont icon-cart"></span> <strong>购物车</strong>
            <div class="cartBox">
            <div class="bjfff"></div><div class="message">购物车内暂无商品，赶紧选购吧</div>    </div></li>
    <li class="fixeBoxLi Service "> <span class="fixeBoxSpan iconfont icon-service"></span> <strong>客服</strong>
      <div class="ServiceBox">
        <div class="bjfffs"></div>
        <dl onclick="javascript:;">
            <dt><img src="/Home/images/s1.jpg" width="75px"></dt>
               <dd><strong>QQ客服1</strong>
                  <p class="p1">9:00-22:00</p>
                   <p class="p2"><a href="http://wpa.qq.com/msgrd?v=3&uin=597837561&site=qq&menu=yes" target="_blank">点击交谈</a></p>
                  </dd>
                </dl>
                <dl onclick="javascript:;">
                  <dt><img src="/Home/images/s1.jpg" width="75px;"></dt>
                  <dd> <strong>QQ客服1</strong>
                    <p class="p1">22:00-9:00</p>
                    <p class="p2"><a href="http://wpa.qq.com/msgrd?v=3&uin=2831992243&site=qq&menu=yes" target="_blank">点击交谈</a></p>
                  </dd>
                </dl>
              </div>
     </li>
     <li class="fixeBoxLi code cart_bd " style="display:block;" id="cartboxs">
            <span class="fixeBoxSpan iconfont icon-erweima"></span> <strong>微信</strong>
            <div class="cartBox">
            <div class="bjfff"></div>
            <div class="QR_code">
             <p><img src="/Home/images/erweim.jpg" width="150px" height="150px" style=" margin-top:10px;" /></p>
             <p>微信扫一扫，关注我们</p>
            </div>      
            </div>
            </li>

    <li class="fixeBoxLi Home"> <a href="/collect"> <span class="fixeBoxSpan iconfont  icon-shoucang"></span> <strong>收藏</strong> </a> </li>
    <li class="fixeBoxLi Home"> <a href="./"> <span class="fixeBoxSpan iconfont  icon-zuji"></span> <strong>足迹</strong> </a> </li>
    <li class="fixeBoxLi Home"> <a href="./"> <span class="fixeBoxSpan iconfont  icon-fankui"></span> <strong>反馈</strong> </a> </li>
    <li class="fixeBoxLi BackToTop"> <span class="fixeBoxSpan iconfont icon-top"></span> <strong>返回顶部</strong> </li>
  </ul>
</div>
</body>
</html>
<script type="text/javascript">
    function addFavorite() {
        var url = window.location;
        var title = document.title;
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf("msie 8") > -1) {
            external.AddToFavoritesBar(url, title, '');//IE8
        } else {
            try {
                window.external.addFavorite(url, title);
            } catch (e) {
                try {
                    window.sidebar.addPanel(title, url, "");//firefox
                } catch (e) {
                    alert("加入收藏失败，请使用Ctrl+D进行添加");
                }
            }
        }
    }

</script>