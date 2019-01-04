@if(count($errors) >0)
<div class="error">
    <p style="background:#FFCBCA;width100%;height:30px;text-align:center;line-height:30px;cursor: pointer;">添加失败</p>
</div>
@endif
@if(session('success'))
<div class="success">
    <p  style="background:#E1F1C0;width100%;height:30px;text-align:center;line-height:30px;cursor: pointer;">添加成功,请等待...</p>
</div> 
@endif
@extends("Index.Public.public")
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<!-- 引入css样式 -->
<link href="/Home/css/friendly_link.css" rel="stylesheet" type="text/css" />
<!-- 引入表单验证错误样式 -->
<link href="/Home/css/friendly_link.css" rel="stylesheet" type="text/css" />
<script src="/Home/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<style>
    .red{border:1px solid red;}
    .green{border:1px solid green;}
</style>
@endsection
@section('main')

        <script type="text/javascript">
        jQuery(".slideBox").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true});
        </script>
        <!-- 删除菜单栏和轮播图 -->
        <script>
        $('#Menu').empty();
        </script>
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
 <!--内容样式-->
 <div class="index_style">
   <!-- 友情链接 -->
   <div class="friendly_link">
       <div class="friendly_linkname"><h4>友情链接</h4></div>
       <!-- 链接内容 -->
       <div class="friendly_linktype">
            <!-- 类型 -->
            <h4>游戏类</h4>
            <!-- 内容 -->
            <ul>
                @foreach($data0 as $row)
                <li><a href="{{$row->url}}" title="{{$row->title}}"><img src="{{$row->logo}}" width="200px" height="40px"></a></li>
                @endforeach
            </ul>
        </div>
        <div class="friendly_linktype">
            <h4>生活类</h4>
            <ul>
                @foreach($data1 as $row1)
                <li><a href="{{$row1->url}}" title="{{$row1->title}}"><img src="{{$row1->logo}}" width="200px" height="40px"></a></li>
                @endforeach 
            </ul>
        </div>
        <div class="friendly_linktype">
            <h4>文学类</h4>
            <ul>
                @foreach($data2 as $row2)
                <li><a href="{{$row2->url}}" title="{{$row2->title}}"><img src="{{$row2->logo}}" width="200px" height="40px"></a></li>
                @endforeach 
            </ul>
        </div>
        <div class="friendly_linktype">
            <h4>新闻类</h4>
            <ul>
                @foreach($data3 as $row3)
                <li><a href="{{$row3->url}}" title="{{$row3->title}}"><img src="{{$row3->logo}}" width="200px" height="40px"></a></li>
                @endforeach 
            </ul>
        </div>
        <div class="friendly_linktype">
            <h4>体育类</h4>
            <ul>
                @foreach($data4 as $row4)
                <li><a href="{{$row4->url}}" title="{{$row4->title}}"><img src="{{$row4->logo}}" width="200px" height="40px"></a></li>
                @endforeach 
            </ul>
        </div>
        <div class="friendly_linktype">
            <h4>其他</h4>
            <ul>
                @foreach($data5 as $row15)
                <li><a href="{{$row5->url}}" title="{{$row5->title}}"><img src="{{$row5->logo}}" width="200px" height="40px"></a></li>
                @endforeach 
            </ul>
        </div>
    </div>
    <div style="clear:both"></div>
        <!-- 友情链接申请 -->
        <div class="friendly_linkapply">
        <div class="friendly_linkname">
            <h4>友情链接申请</h4>
        </div>
        <div class="friendly_linkapply_left">
               <p>申请步骤</p>
               <p>1.请先在贵网站做好鲜盟网的文字友情链接</P>
               <p>2.做好后请在右侧填写好申请信息</P>
               <p>3.已开通我站友情链接并且内容键康，符合本站友情链接要求的网站，京本站审核后，可以显示在本站友情链接上</P>
        </div>
        <div class="friendly_linkapply_right">  
            <h4>申请信息</h4>
            <form action="/indexlink" method="post"  enctype="multipart/form-data" onsubmit="">
                <p class="p">标　题 : <input type="text" class="small" id="title" name="title" value="{{old('title')}}" reminder="请输入标题" required><span></span></p>
                <p class="p">链　接 : <input type="text" class="small" id="url" name="url" value="{{old('url')}}"><span></span></p>
                <p class="p">联系人 : <input type="text" class="small" id="name" name="name" value="{{old('name')}}"  reminder="请输入联系人姓名" required><span></span></p>
                <p class="p">电　话 : <input type="text" class="small " id="phone" name="phone" value="{{old('phone')}}" reminder="请输入电话" required><span></span></p>
                <p class="p">类　型 : <select name="type">
                            <option value="0" selected>游戏类</option>
                            <option value="1">生活类</option>
                            <option value="2">文学类</option>
                            <option value="3">新闻类</option>
                            <option value="4">体育类</option>
                            <option value="5">其他</option>
                        </select>
                </p>
                <p class="p">logo : <input type="file" class="small" id="logo" name="logo" required></p>
                <p class="p">
                {{csrf_field()}}
                    <input type="submit" class="btn btn-danger" id="tianjia" value="添加">
                    <input type="reset" class="btn " value="重置">   
                </p>
            </form>
            <script>
                // 添加提示信息
                $("input[name!='logo']").click(function(){
                    reminder = $(this).attr('reminder');
                    $(this).next('span').css('color','red').html(reminder);
                    // 添加类样式
                    $(this).addClass('red');
                });

                // 绑定手机失去焦点事件，判断手机号码的格式是否正确
                $("input[name='phone']").blur(function(){
                    phone = $(this).val();
                    o = $(this);
                    // alert(phone);
                    // 匹配正则
                    if (phone.match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)==null) {
                        $(this).next('span').css('color','red').html('手机号码格式不正确');
                        $(this).addClass('red');
                        // 阻止表单提交
                        $('form').attr('onsubmit','return false');
                        $('input[type=submit]').attr('disabled','true');
                    }else{
                        // 用正则判断电话号码是否唯一
                        $.get('linkphone',{phone:phone},function(data){
                            // alert(data) 
                            if(data==1){
                                o.next('span').css('color','red').html('手机号码已存在，请更换');
                                o.addClass('red');
                                // 阻止表单提交
                                $('form').attr('onsubmit','return false');
                                $('input[type=submit]').attr('disabled','true');
                            }else{
                                o.next('span').css('color','green').html('手机号码正确');
                                o.addClass('green');
                                // 允许表单提交
                                $('form').attr('onsubmit','return true');
                                $('#tianjia').removeAttr('disabled');
                            }
                        })
                    }
                });

                $('#title').blur(function(){
                    if ($(this).val()) {
                        $(this).next('span').css('color','green').html('标题正确');
                        $(this).addClass('green');
                        // 允许表单提交
                        $('form').attr('onsubmit','return true');
                        $('#tianjia').removeAttr('disabled');
                    }else{
                        $(this).next('span').css('color','red').html('请输入标题');
                        $(this).addClass('red');
                        // 阻止表单提交
                        $('form').attr('onsubmit','return false');
                        $('input[type=submit]').attr('disabled','true');
                    }
                });

                $('#url').blur(function(){
                    u = $(this).val();
                    if (u.match(/^https:\/\/([\w-]+\.)+[\w-]+(\/[\w-.\/?%&=]*)?$/)==null) {
                        $(this).next('span').css('color','red').html('链接地址格式不正确');
                        $(this).addClass('red');
                        // 阻止表单提交
                        $('form').attr('onsubmit','return false');
                        $('input[type=submit]').attr('disabled','true');
                    }else{
                        $(this).next('span').css('color','green').html('链接地址格式正确');
                        $(this).addClass('green');
                        // 允许表单提交
                        $('form').attr('onsubmit','return true');
                        $('#tianjia').removeAttr('disabled');
                    }
                });

                $('#name').blur(function(){
                     if ($(this).val()) {
                        $(this).next('span').css('color','green').html('联系人正确');
                        $(this).addClass('green');
                        // 允许表单提交
                        $('form').attr('onsubmit','return true');
                        $('#tianjia').removeAttr('disabled');
                    }else{
                        $(this).next('span').css('color','red').html('请输入联系人');
                        $(this).addClass('red');
                        // 阻止表单提交
                        $('form').attr('onsubmit','return false');
                        $('input[type=submit]').css('disabled','true');
                    }
                });

                
            </script>
        </div>
    </div>
</div>
@endsection
