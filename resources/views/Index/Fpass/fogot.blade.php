<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" contect="http://www.webqin.net">
<title>忘记密码</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link type="text/css" href="/Foget/css/css.css" rel="stylesheet" />
<script src="/Home/js/jquery.min.1.8.2.js" type="text/javascript"></script>

</head>

<body>
 
  <div class="content">
   <div class="web-width">
     <div class="for-liucheng">
      <div class="liulist for-cur"></div>
      <div class="liulist"></div>
      <div class="liulist"></div>
      <div class="liulist"></div>
      <div class="liutextbox">
       <div class="liutext for-cur"><em>1</em><br /><strong>填写账户名</strong></div>
       <div class="liutext"><em>2</em><br /><strong>验证身份</strong></div>
       <div class="liutext"><em>3</em><br /><strong>设置新密码</strong></div>
       <div class="liutext"><em>4</em><br /><strong>完成</strong></div>
      </div>
     </div><!--for-liucheng/-->
     <form action="/doforget" method="get" class="forget-pwd">
     
       <dl>
        <dt>邮箱：</dt>
        <dd><input type="email" name="email" />
        @if(session('error'))
        <font style="font-size: 16px;color: red;margin-left: 10px">{{session('error')}}</font>
        @endif
        </dd>
        <div class="clears" ></div>
       </dl> 
       <dl>
        <dt>验证码：</dt>
        <dd>
         <input type="text" name="yzm" /> 
         <div class="yanzma">
          <img class="cc" src="/code" width="100px" height="26px" onclick="this.src=this.src+'?a=1'"/> <span onclick="check()">换一换</span>
         </div>
        </dd>
        <div class="clears"></div>
       </dl>
       <div class="subtijiao"><input type="submit" value="提交" /></div> 
      </form><!--forget-pwd/-->
   </div><!--web-width/-->
  </div><!--content/-->
  
</body>
<script>
  // alert(1);
  // alert($);
  function check(){
  //   $dd = $('.cc').attr('src');
  //   $dd = $src+'?a=1';
  }
</script>
</html>
