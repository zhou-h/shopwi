﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" contect="http://www.webqin.net">
<title>忘记密码</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link type="text/css" href="/Foget/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/Foget/js/jquery-1.8.3-min.js"></script>

</head>

<body>

  <div class="content">
   <div class="web-width">
     <div class="for-liucheng">
      <div class="liulist for-cur"></div>
      <div class="liulist for-cur"></div>
      <div class="liulist"></div>
      <div class="liulist"></div>
      <div class="liutextbox">
       <div class="liutext for-cur"><em>1</em><br /><strong>填写账户名</strong></div>
       <div class="liutext for-cur"><em>2</em><br /><strong>验证身份</strong></div>
       <div class="liutext"><em>3</em><br /><strong>设置新密码</strong></div>
       <div class="liutext"><em>4</em><br /><strong>完成</strong></div>
      </div>
     </div><!--for-liucheng/-->
     <div class="successs">
       <h3>验证发送成功，请登录邮箱修改密码</h3>
      </div>
   </div><!--web-width/-->
  </div><!--content/-->
  
</body>
<script type="text/javascript">
 //导航定位

 $(function(){
  // $(".nav li:eq(2) a:first").addClass("navCur")
   //验证手机 邮箱 
   $(".selyz").change(function(){
     var selval=$(this).find("option:selected").val();
     if(selval=="0"){
       $(".sel-yzsj").show()
       $(".sel-yzyx").hide()
       $('.sel_aa').hide()
       $('.sel_dd').show()
       }
     else if(selval=="1"){
       $(".sel-yzsj").hide()
       $(".sel-yzyx").show()
       $('.sel_dd').hide()
       $('.sel_aa').show()
       }
     })
   })
</script>
</html>
