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
<!--订单详情管理-->
<!--订单管理-->
  <div class="user_style clearfix">
    <div class="user_center">、  
  <!--右侧样式-->
   <div class="right_style">
     <div class="info_content">   
      <div class="title_Section"><span>订单管理</span></div>
      <div class="Order_Sort">
      </div>
      <div class="Order_form_list">
         <table>
         <thead>
          <tr><td class="list_name_title0">地址信息</td>
          <td class="list_name_title1">单价(元)</td>
          <td class="list_name_title2">数量</td>
          <td class="list_name_title4">邮编</td>
          <td class="list_name_title5">电话</td>
          <td class="list_name_title6">操作</td>
         </tr></thead> 
         <tbody>       
           <tr class="Order_info"><td colspan="6" class="Order_form_time">收件人：{{$address->name}} | 订单号：{{$orders_info->order_num}} <em></em></td></tr>
           <tr class="Order_Details">
           <td colspan="3">
           <table class="Order_product_style">
           <tbody><tr>
           <td>
            <div class="product_name clearfix">
            <a href="#" class="product_img"><img src="{{$orders_info->pic}}" width="80px" height="80px"></a>
            <a href="3">{{$address->address}}</a>
            <p class="specification">{{$address->addre_s}}</p>
            </div>
            </td>
            <td>{{$orders_info->price}}</td>
           <td>{{$orders_info->num}}</td>
            </tr>
            </tbody></table>
           </td>   
           <td class="split_line">{{$address->pc}}</td>
           <td class="split_line">{{$address->phone}}</td>
           <td class="operating"><a href="/orderuser">返回</a></td>
           </tr>
           </tbody>
                       
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
