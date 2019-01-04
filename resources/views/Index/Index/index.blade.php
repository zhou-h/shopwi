@extends("Index.Public.public")
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
<!--幻灯片样式-->
   	<div id="slideBox" class="slideBox">
			<div class="hd">
				<ul class="smallUl"></ul>
			</div>
			<div class="bd">
				<ul>
        @foreach($carouse as $c)
					<li><a href="" target="_blank"><div style="background:url({{$c->pic}}) no-repeat rgb(255, 227, 130); background-position:center; width:100%; height:460px;"></div></a></li>
				@endforeach
				</ul>
			</div>
			<!-- 下面是前/后按钮代码，如果不需要删除即可 -->
			<a class="prev" href="javascript:void(0)"></a>
			<a class="next" href="javascript:void(0)"></a>

		</div>
		<script type="text/javascript">
		jQuery(".slideBox").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true});
		</script>
 </div>
 <!--内容样式-->
 <div class="index_style">
   <!--推荐图层样式-->
   <div class="recommend">
   <div class="recommend_bg"></div>
   <div class="list">
     <div class="picScroll">
        <div class="hd">
        <a class="prev" href="javascript:void(0)">&gt;</a>
		<a class="next" href="javascript:void(0)">&lt;</a>
        </div>
        <div class="bd">
          <div class="tempWrap" >
          <ul>
          @foreach($goods as $v)
            <li class="recommend_info">
             <div class="img_link"> 
             <a href="/detail/{{$v->id}}" class=""><img src="{{$v->pic}}" width="110px" height="150px"></a>
             </div>           
                <div class="content">
                  <a href="/detail/{{$v->id}}" class="title_name">{{$v->name}}</a>
                  <h2><i>￥</i>{{$v->price}}</h2>          
                </div>
               <a href="/detail/{{$v->id}}" class="buy_btn"> 立即购买</a>
             </li>
           @endforeach
          </ul>
          </div>
        </div>			
     </div>
     <script>jQuery(".picScroll").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:4});</script>
   </div>
  </div>
  <!--店铺样式-->
  <!-- <div class="Shops_style clearfix">
    <div class="title_name">
    <span>鲜盟店铺</span>
    </div>
     <div class="Shops_list clearfix">
     <ul>
      <li>
        <div class="Shops_area"><a href="#">四川成都武侯区</a></div>
        <div class="Shops_address">
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
        </div>
      </li>
      <li>
        <div class="Shops_area"><a href="#">四川成都武侯区</a></div>
        <div class="Shops_address">
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
        </div>
      </li>
       <li>
        <div class="Shops_area"><a href="#">四川成都金牛区</a></div>
        <div class="Shops_address">
         <a href="#">金牛区金沙公交站一点</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
        </div>
      </li>
       <li>
        <div class="Shops_area"><a href="#">四川成都武侯区</a></div>
        <div class="Shops_address">
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
        </div>
      </li>
      <li>
        <div class="Shops_area"><a href="#">四川成都武侯区</a></div>
        <div class="Shops_address">
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
         <a href="#">武侯分店一部</a>
        </div>
      </li>
     </ul>
    </div>
  </div> -->
  <!--样式-->
  <div class="clearfix">
   <div class="news_P">
    <div class="slideTxtBox">
		  <div class="parHd">
				<!-- 下面是前/后按钮代码，如果不需要删除即可 -->
				<span class="arrow"><a class="next"></a><a class="prev"></a></span>
				<ul><li class="">最新订单</li><li class="on">商城新闻</li></ul>
			</div>
			<div class="parBd">
				<ul class="Order_list">
                 <div class="picMarquee-top">
                 <div class="hd"></div>
                   <div class="bd">
                   <ul>
					<li class="clearfix">                   
                    <a href="#" target="_blank" class="img_link"><img src="/Home/products/p_56.jpg"  width="60" height="60"/></a>
                    <a href="#" class="name">史努比（SNOOPY）净含量30克 梦系列薄荷糖（甜橙味）</a>
                    <h2>总价：<b>￥123</b></h2>
                    <h4>下单时间：2016年5月2日 12:43:03</h4>
                    </li>	
                    <li class="clearfix">                   
                    <a href="#" target="_blank" class="img_link"><img src="/Home/products/p_56.jpg"  width="60" height="60"/></a>
                    <a href="#" class="name">史努比（SNOOPY）净含量30克 梦系列薄荷糖（甜橙味）</a>
                    <h2>总价：<b>￥123</b></h2>
                    <h4>下单时间：2016年5月2日 12:43:03</h4>
                    </li>
                    <li class="clearfix">                   
                    <a href="#" target="_blank" class="img_link"><img src="/Home/products/p_56.jpg"  width="60" height="60"/></a>
                    <a href="#" class="name">史努比（SNOOPY）净含量30克 梦系列薄荷糖（甜橙味）</a>
                    <h2>总价：<b>￥123</b></h2>
                    <h4>下单时间：2016年5月2日 12:43:03</h4>
                    </li>
                    <li class="clearfix">                   
                    <a href="#" target="_blank" class="img_link"><img src="/Home/products/p_56.jpg"  width="60" height="60"/></a>
                    <a href="#" class="name">史努比（SNOOPY）净含量30克 梦系列薄荷糖（甜橙味）</a>
                    <h2>总价：<b>￥123</b></h2>
                    <h4>下单时间：2016年5月2日 12:43:03</h4>
                    </li>
                    </ul>	
                    </div>	
                    </div>
				 <script>jQuery(".slideTxtBox .picMarquee-top").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:2,interTime:50,trigger:"click"});</script>
				</ul>
				<ul>
				
                    @foreach($notice as $not)
                    <li><a href="#" target="_blank">{!!$not->content!!}</a></li>
                    @endforeach	
                    
				</ul>				
			</div>
		</div>
        <script type="text/javascript">jQuery(".slideTxtBox").slide({titCell:".parHd li",mainCell:".parBd"});</script>
   </div>
   <div class="Hot_p">
   <!--热销产品-->
   <div class="hot_silde">
     <div class="hd"><em></em>热销产品<ul></ul></div>
    <div class="bd">
     <ul>
      @foreach($goodtop as $row)
      <li>
        <a href="/detail/{{$row->id}}" class="imglibk"><img src="{{$row->pic}}"  width="160" height="160"/></a>
        <a href="/detail/{{$row->id}}" class="name">{{$row->name}}</a>
        <div class="infostyle"><span class="Price"><b>￥</b>{{$row->price}}</span><span class="Quantity">销售：<b>{{$row->sales}}</b>件</span></div>
      </li>
       @endforeach
     </ul>
    </div>
     <a class="next" href="javascript:void(0)">&lt;</a>
      <a class="prev" href="javascript:void(0)">&gt;</a>
   </div>
      <script type="text/javascript">
		jQuery(".hot_silde").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,scroll:4,vis:4,interTime:5000,trigger:"click"});
		</script>
   </div>
  </div>
  <!--限时促销-->

  <div class="AD_tu"><a href="#"><img src="/Home/AD/ad-4.jpg"  width="1200" height="120"/></a></div>
  <!--产品类样式-->
  <div class="product_Sort">
   <div class="title_name"><span class="floor">1F</span><span class="name">水果蔬菜</span>
   @foreach($daa as $value)
   <span class="link_name"><a href="#">{{$value}}</a> | </span>
   @endforeach
   </div>
   <div class="Section_info clearfix">
    <div class="product_AD">
      <div class="pro_ad_slide">
       <div class="hd">
        <ul><li class="on">1</li><li class="">2</li></ul>
       </div>
       <div class="bd">
        <ul>
        <li style="display: list-item;"><a href="#"><img src="/Home/AD/ad-6.jpg" width="398" height="469"></a></li>
        <li style="display: none;"><a href="#"><img src="/Home/AD/ad-7.jpg" width="398" height="469"></a></li>
        </ul>
       </div>
        <a class="prev" href="javascript:void(0)"><em class="arrow"></em></a>    
         <a class="next" href="javascript:void(0)"><em class="arrow"></em></a>
     </div>
     <script type="text/javascript">
    jQuery(".pro_ad_slide").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true,interTime:6000});
    </script>
    </div>
    <!--产品列表1-->
    <div class="pro_list">
      <ul>
        @foreach($data as $v)
         <li>
            <a href="/detail/{{$v->gid}}"><img src="{{$v->pic}}" width="180px" height="160px"></a>
            <a href="/detail/{{$v->gid}}" class="p_title_name">{{$v->gname}}</a>
            <div class="Numeral"><span class="price"><i>￥</i>{{$v->price}}</span><span class="Sales">销量<i>{{$v->sales}}</i>件</span></div>
         </li>
        @endforeach
      </ul>
     </div>
   </div> 
  </div>
  <div class="product_Sort">
   <div class="title_name"><span class="floor">2F</span><span class="name">水果蔬菜</span>
   @foreach($daa2 as $value)
   <span class="link_name"><a href="#">{{$value}}</a> | </span>
   @endforeach
   </div>
   <div class="Section_info clearfix">
    <div class="product_AD">
      <div class="pro_ad_slide">
       <div class="hd">
        <ul><li class="on">1</li><li class="">2</li></ul>
       </div>
       <div class="bd">
        <ul>
        <li style="display: list-item;"><a href="#"><img src="/Home/AD/ad-7.jpg" width="398" height="469"></a></li>
        <li style="display: none;"><a href="#"><img src="/Home/AD/ad-8.jpg" width="398" height="469"></a></li>
        </ul>
       </div>
        <a class="prev" href="javascript:void(0)"><em class="arrow"></em></a>    
         <a class="next" href="javascript:void(0)"><em class="arrow"></em></a>
     </div>
     <script type="text/javascript">
    jQuery(".pro_ad_slide").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true,interTime:6000});
    </script>
    </div>
    <!--产品列表2-->
    <div class="pro_list">
      <ul>

        @foreach($data2 as $v)
         <li>
            <a href="/detail/{{$v->gid}}"><img src="{{$v->pic}}" width="180px" height="160px"></a>
            <a href="/detail/{{$v->gid}}" class="p_title_name">{{$v->gname}}</a>
            <div class="Numeral"><span class="price"><i>￥</i>{{$v->price}}</span><span class="Sales">销量<i>{{$v->sales}}</i>件</span></div>
         </li>
        @endforeach
       
      </ul>
     </div>
   </div> 
  </div>
    <div class="product_Sort">
   <div class="title_name"><span class="floor">3F</span><span class="name">水果蔬菜</span>
   @foreach($daa2 as $value)
   <span class="link_name"><a href="#">{{$value}}</a> | </span>
   @endforeach
   </div>
   <div class="Section_info clearfix">
    <div class="product_AD">
      <div class="pro_ad_slide">
       <div class="hd">
        <ul><li class="on">1</li><li class="">2</li></ul>
       </div>
       <div class="bd">
        <ul>
        <li style="display: list-item;"><a href="#"><img src="/Home/AD/ad-7.jpg" width="398" height="469"></a></li>
        <li style="display: none;"><a href="#"><img src="/Home/AD/ad-8.jpg" width="398" height="469"></a></li>
        </ul>
       </div>
        <a class="prev" href="javascript:void(0)"><em class="arrow"></em></a>    
         <a class="next" href="javascript:void(0)"><em class="arrow"></em></a>
     </div>
     <script type="text/javascript">
    jQuery(".pro_ad_slide").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true,interTime:6000});
    </script>
    </div>
    <!--产品列表3-->
    <div class="pro_list">
      <ul>
        @foreach($data3 as $v)
         <li>
            <a href="/detail/{{$v->gid}}"><img src="{{$v->pic}}" width="180px" height="160px"></a>
            <a href="/detail/{{$v->gid}}" class="p_title_name">{{$v->gname}}</a>
            <div class="Numeral"><span class="price"><i>￥</i>{{$v->price}}</span><span class="Sales">销量<i>{{$v->sales}}</i>件</span></div>
         </li>
        @endforeach
      </ul>
     </div>
   </div> 
  </div>
  <!--猜你喜欢样式-->
<div class="like_p">
    <div class="title_name"><span>猜你喜欢</span></div>
    <div class="list">
      <ul class="list_style">
       <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_13.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
         <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_15.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
         <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_16.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
         <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_17.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
         <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_18.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
         <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_19.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
        <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_24.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
        <li class="p_info_u">
        <a href="#" class="p_img"><img src="/Home/products/p_32.jpg"></a>
        <a href="#" class="name">御泥坊 玫瑰滋养+红石榴亮颜美肤套装 深层补水滋润 提亮肤色</a>
        <div class="Numeral"><span class="price"><i>￥</i>123.00</span><span class="Sales">销量<i>345</i>件</span></div>
       </li>
      </ul>
    </div>
  </div>
  </div>
  @endsection
