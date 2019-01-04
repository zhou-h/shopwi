<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" contect="http://www.webqin.net">
<title>重置密码</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link type="text/css" href="/Foget/css/css.css" rel="stylesheet" />
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>

</head>

<body>

  <div class="content">
   <div class="web-width">
     <div class="for-liucheng">
      <div class="liulist for-cur"></div>
      <div class="liulist for-cur"></div>
      <div class="liulist for-cur"></div>
      <div class="liulist"></div>
      <div class="liutextbox">
       <div class="liutext for-cur"><em>1</em><br /><strong>填写账户名</strong></div>
       <div class="liutext for-cur"><em>2</em><br /><strong>验证身份</strong></div>
       <div class="liutext for-cur"><em>3</em><br /><strong>设置新密码</strong></div>
       <div class="liutext"><em>4</em><br /><strong>完成</strong></div>
      </div>
     </div><!--for-liucheng/-->
     <form action="/doreset" method="get" class="forget-pwd" id="doreset">
       <dl>
        <dt>新密码：</dt>
        <dd><input type="password" name="password" id="pass" /><font id="font1" style="margin-left: 5px"></font></dd>
        <div class="clears"></div>
       </dl> 
       <dl>
        <dt>确认密码：</dt>
        <dd><input type="password" name="repassword" id="repass" /><font id="font2" style="margin-left: 5px"></font></dd>
        <div class="clears"></div>
       </dl> 
       <input type="hidden" name="id"  value="{{$id}}" />
       <div class="subtijiao"><input type="submit" value="提交" /></div> 
      </form><!--forget-pwd/-->
   </div><!--web-width/-->
  </div><!--content/-->
  
</body>
<script>
var UNP = false;
var OOD = false;
  $('#pass').blur(function(){
    str = $('#pass').val();
    if(str==""){
        $('#font1').html('请输入密码').css('color','red');
      UNP=false;
    }else{
        $('#font1').html('可以使用').css('color','blue');
      UNP=true;
    }
  });
  $('#repass').blur(function(){
    str1 = $('#repass').val();
    if(str1==""){
        $('#font2').html('请输入重复密码').css('color','red');
      OOD=false;
    }else if(str==str1){
        $('#font2').html('密码一致').css('color','blue');
      OOD=true;
    }else{
      $('#font2').html('密码不一致').css('color','red');
      OOD=false;
    }
  });

  $('#doreset').submit(function(){
    // 自动触发
    $('input').trigger('blur');
    if(UNP && OOD){
      return true;
    }else{
      return false;
    }
  });
</script>
</html>
