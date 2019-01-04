@extends('Index.Public.public')
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/show.css" rel="stylesheet" type="text/css" />
<link href="/Home/css/purebox-metro.css" rel="stylesheet" id="skin">
<link href="/Home/css/sumoselect.css" rel="stylesheet"  type="text/css"/>
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/Home/js/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<style type="text/css">
  #orderinput{
    margin-top: 5px;
    height: 30px;
  }
  #sid{
    width: 60px;

  }
  .Add_Addresss table tr{
    line-height: 40px;
    /*border-bottom: 1px solid black; */
  }
</style>
<script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
        });
    </script>
@endsection
@section('main')
<!--添加收货地址订单样式-->
 <div class="Inside_pages clearfix" id="Orders">
 <div class="Process"><img src="/Home/images/orderaddress.jpg" width="1200px" height="200px" /></div>
 <div class="Orders_style clearfix" >
   <!--地址信息样式-->
   <div class="Address_info">
    <div class="title_name">添加收货地址</div>
    <ul>
     <form method="post" action="/orderdoadd">
        <div class="Add_Addresss" style="background-color: #eee;">
             <table style="width: 1160px;margin-left:10px">
              <tbody>
                <input type="hidden" name="address">
                <tr>
               <td class="label_name">收货区域</td>
               <td colspan="3" class="select" >
                <label> 省/市/区(县) </label><select class="kitjs-form-suggestselect" id="sid" ></select>
               </td>
               </tr>
               <tr>
                <td class="label_name">详细地址</td><td><input name="addre_s" id="addre_s" type="text" class="Add-text"><i>（请输入街和街号）</i></td>
                <td class="label_name">邮&nbsp;&nbsp;编</td><td><input name="pc" id="pc" type="text" class="Add-text"><i>（请输入正确的邮政编码）</i></td>
              </tr>
              <tr>
                <td class="label_name">收件人姓名</td><td><input name="name" id="name" type="text" class="Add-text"><i>（请输入正确的姓名）</i></td>
                <td class="label_name">电子邮箱</td><td><input name="email" id="email" type="text" class="Add-text"><i>（请输入正确的邮箱）</i></td>
              </tr>
              <tr>
                
                <td class="label_name">手&nbsp;&nbsp;机</td><td><input name="phone" id="phone" type="text" class="Add-text"><i>（请输入正确的手机号码）</i></td>
                <td class="label_name">固定电话</td><td><input name="t_phone" id="t_phone" type="text" class="Add-text"><i>（请输入正确的固定号码）</i></td></tr>
              </tr>
              <tr>
              
              <tr><td class="label_name"></td><td></td><td class="label_name"></td><td></td>
              </tr>             
             </tbody></table>
             <div class="address_Note"><span>注：</span>只能添加5个收货地址信息。请乎用假名填写地址，如造成损失由收货人自己承担。</div>
             {{csrf_field()}}
             <div class="btn"><input  id="submit" type="submit" value="添加地址" class="Add_btn"></div>
         </div>
       </form>
    </ul>
   </div>
 </div>
 </div>
 <script type="text/javascript">
  
  // 详细地址验证
  $('#addre_s').blur(function(){
    addre_s=$(this).val();
    if(addre_s.match(/^.+(路|街).+号.*$/)==null){
      $(this).next().html('请输入街和街号').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入地址成功').css('color','green');
    }
  });
  // 邮政验证
  $('#pc').blur(function(){
    pc=$(this).val();
    if(pc==null){
      $(this).next().html('请输入正确的邮政').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入邮政成功').css('color','green');
    }
  });
  // 收件名验证
  $('#name').blur(function(){
    name=$(this).val();
    if(addre_s.match(/^[\u4E00-\u9FA5A-Za-z0-9_]+$/)==null){
      $(this).next().html('请输入正确的姓名格式').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入姓名成功').css('color','green');
    }
  });
  // 电子邮箱验证
  $('#email').blur(function(){
    email=$(this).val();
    if(email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
      $(this).next().html('请输入正确的电子邮箱').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入邮箱成功').css('color','green');
    }
  });
  // 手机
  $('#phone').blur(function(){
    phone=$(this).val();
    if(phone.match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)==null){
      $(this).next().html('请输入正确的手机').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入手机号码成功').css('color','green');
    }
  });
  // 座机验证
  $('#t_phone').blur(function(){
    t_phone=$(this).val();
    if(t_phone==null){
      $(this).next().html('请输入正确的固定电话').css('color','red');
      $('#submit').css('disabled',true);
    }else{
      $(this).next().html('输入固定电话成功').css('color','green');
    }
  });

  // 三级导航
  // 获取省
      $.get('/orderyiji',{uid:0},function(data){
        // console.log(data);
        for(i=0;i<data.length;i++){
          // 将获取到的省份加入到option里
          $info=$('<option value="'+data[i].id+'">'+data[i].name+'</option>');
          // 将option标签添加带#sid里
          $('#sid').append($info);
        }
      },'json');
   //其他级别内容
    //live事件委派,可以帮助我们将动态生成的内容,只要选择器相同就可以有相应的事件
    //select值改变事件
    $('select').live('change',function(){
        //将当前的select对象存储起来,用于后面添加新的select使用
        obj=$(this);
        //通过id来查找下一个,用于后面的内容
        id=$(this).val();
        //清除所有其他的select
        obj.nextAll('select').remove();

        $.get('./orderyiji',{'uid':id},function(data){
            if(data!=''){
              console.log(data);
                var select=$('<select></select>');

                //循环输出相应城市内容
                for(var i=0;i<data.length;i++){
                    //添加城市到第二个新加的select
                    var info=$('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                    select.append(info);
                }
                //将select标签添加到当前标签的后面
                obj.after(select);
            }
            //设置请选择选项不能选
            // $('.mm').attr('disabled','true');
        },'json');
    });
    //获取选择的数据提交到操作页面
    $(':submit').click(function(){
        // console.log($('select'));
        //用于存储选中的内容
        arr=[];
        //手动循环
        $('select').each(function(){
            //找出选中的内容,即每个select中的option选项被写上selected
            opdata=$(this).find('option:selected').html();
            // console.log(opdata);

            //将选中的内容放入新数组中
            arr.push(opdata);
        })
        //将得到的数组直接赋值给隐藏域的value即可
        $('input[name=address]').val(arr);
    })

 </script>
 @endsection
 @section('title','添加订单地址')
 

