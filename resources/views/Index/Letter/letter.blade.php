@if(count($errors) >0)
<div class="error">
    <p style="background:#FFCBCA;width100%;height:30px;text-align:center;line-height:30px;cursor: pointer;">发表失败</p>
</div>
@endif
@if(session('success'))
<div class="success">
    <p  style="background:#E1F1C0;width100%;height:30px;text-align:center;line-height:30px;cursor: pointer;">发表成功</p>
</div> 
@endif
@extends("Index.Public.public")
@section('css')
<link href="/Home/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Home/fonts/iconfont.css"  rel="stylesheet" type="text/css" />
<link href="/Home/css/style.css" rel="stylesheet" type="text/css" />
<!-- 引入css样式 -->
<link href="/Home/css/letter.css" rel="stylesheet" type="text/css" />
<script src="/Home/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/Home/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/Home/js/common_js.js" type="text/javascript"></script>
<script src="/Home/js/footer.js" type="text/javascript"></script>
<style>
    .red{border:1px solid red;}
    .green{border:1px solid green;}
    .letter_inbox_left ul li:hover{background: lightblue;}
    .letter_inbox .letter_inbox_left p:hover{background: #ff6700;}
    .letter_inbox .letter_inbox_left p{text-align:left;}
    .bc{background: #ff6700;}
    .lc{background: lightblue;}
    .letter_outbox_left ul li:hover{background: #ff6700;}

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
    <div class="letter_title">
        <ul>
            <li id="transmit" class="white" onclick="menu(1)">发站内信</li>
            <li id="inbox" onclick="menu(2)">收信箱</li>
            <li id="outbox" onclick="menu(3)">发信箱</li>
        </ul>
    </div>
    <!-- 清除浮动 -->
    <div style="clear:both"></div>
    <div class="letter_content" style="height:400px;">
        <!-- 发站内信的内容 -->
        <div class="letter_transmit" style="display:block;">
            <form action="/indexletter" method="post">
                <div style="width:900px;">
                    <p>收件人<input name="sender" class="input" reminder="请输入收件人账号" required><span></span></p>
                </div>
                <div style="width:900px;">
                    <p>标　题<input name="title" class="input" reminder="请输入标题" required><span></span></p>
                </div>
                <div style="width:900px;">
                    <p>内　容<textarea name="content" class="textarea" reminder="请输入内容" required></textarea><span></span>
                </p>
                </div>
                <div>
                <input type="hidden" value="{{session('username')}}" name="consignee">
                <input type="hidden" name="addtime" value="{{time()}}">
                <input type="hidden" name="status" value="0">
                {{csrf_field()}}
                    <input type="submit" value="发送" class="tijiao">
                </div>
            </form>
        </div>

        <!-- 收件箱 -->
        <div class="letter_inbox" style="display:none;height:400px">
            <div class="letter_inbox_left">
                <p class="bc">所有收件</p>
                <p class="inboxno" name="fan" onclick="weidu()">未读</p>
                <ul style="display:none;">
                    @foreach($inboxno as $no)
                    <li onclick="inselect({{$no->id}})">{{$no->consignee}}</li>
                    @endforeach
                </ul>
                <p class="inboxyes" name="fan" onclick="yidu()">已读</p>
                <ul style="display:none">
                    @foreach($inboxyes as $yes)
                    <li onclick="yesselect({{$yes->id}})">{{$yes->consignee}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="letter_inbox_right" style="height:400px">
                @foreach($inbox as $row)
                    <p class="{{$row->id}}">发件人：{{$row->consignee}}</p>
                    <p class="{{$row->id}}" style="width:700px;text-align:center;">{{$row->title}}</p>
                    <p class="{{$row->id}}" style="width:700px;text-indent:2em;">{{$row->content}}</p>
                    <p class="{{$row->id}}">{{date('Y-m-d H:i:s',$row->addtime)}}</p>
                    <p  class="{{$row->id}}" style="border-bottom:1px solid black"></p>
                @endforeach
            </div>
        </div>
        <!-- 清除浮动 -->
        <div style="clear:both"></div>

        <!-- 发件箱 -->
        <div class="letter_outbox" style="display:none;height:400px">
            <div class="letter_outbox_left" style="height:400px">
                <ul>
                    <li style="text-align:left" onclick="allsender()">全部收信人</li>
                    @foreach($outbox as $out)
                    <li onclick="outselect({{$out->id}})">{{$out->sender}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="letter_outbox_right" style="height:400px">
                @foreach($outbox as $out)
                <p class="{{$out->id}}">收件人:{{$out->sender}}</p>
                <p class="{{$out->id}}" style="width:700px;text-align:center;">{{$out->title}}</p>
                <p class="{{$out->id}}" style="width:700px;text-indent:2em;">{{$out->content}}</p>
                <p class="{{$out->id}}">{{date('Y-m-d H:i:s',$row->addtime)}}</p>
                <p  class="{{$out->id}}" style="border-bottom:1px solid black"></p>
                @endforeach
            </div>
        </div>
        <!-- 清除浮动 -->
        <div style="clear:both"></div>
    </div>
</div>
<script>
    function menu(id){
        // 菜单栏的js样式
        // 发站内信
        if (id==1) {
            $('.letter_title ul li').removeClass('white');
            $('#transmit').addClass('white');
            $('.letter_inbox').css('display','none');
            $('.letter_outbox').css('display','none');
            $('.letter_transmit').css('display','block');
        }
        // 收信箱
        if (id==2) {
            $('.letter_title ul li').removeClass('white');
            $('#inbox').addClass('white');
            $('.letter_transmit').css('display','none');
            $('.letter_outbox').css('display','none');
            $('.letter_inbox').css('display','block');
        }

        // 发信箱
        if (id==3) {
            $('.letter_title ul li').removeClass('white');
            $('#outbox').addClass('white');
            $('.letter_transmit').css('display','none');
            $('.letter_inbox').css('display','none');
            $('.letter_outbox').css('display','block');
        }
    }
      // 未读的js
     function weidu(){
        if ($('.inboxno').attr('name')=='fan') {
            $('.letter_inbox_left p:first').removeClass('bc');
            $('.letter_inbox_left p:last').removeClass('bc');
            $('.letter_inbox_left p:nth(1)').addClass('bc').next().css('display','block');
            $('.inboxno').attr('name','shou');
        }else{
            $('.letter_inbox_left p:nth(1)').addClass('bc').next().css('display','none');
            $('.inboxno').attr('name','fan');
        } 
    }

    // 右边内容选择的js
    function inselect(id){
        $('.letter_inbox_right p').css('display','none');
        $('.'+id).css('display','block');
        $.get('/lettersta',{id:id},function(data){
            // alert(data);
        });
    }

    // 所有收件
    $('.letter_inbox_left p:first').click(function(){
        $('.letter_inbox_right p').css('display','block');
        $('.letter_inbox_left p').removeClass('bc');
        $('.letter_inbox_left p:first').addClass('bc');

    })

    // 已读
    function yidu(){
        if ($('.inboxyes').attr('name')=='fan') {
            $('.letter_inbox_left p:first').removeClass('bc');
            $('.letter_inbox_left p:nth(1)').removeClass('bc');
            $('.letter_inbox_left p:last').addClass('bc').next().css('display','block');
            $('.inboxyes').attr('name','shou');
        }else{
            $('.letter_inbox_left p:last').addClass('bc').next().css('display','none');
            $('.inboxyes').attr('name','fan');
        } 
    }
    // 右边已读内容选择的js
    function yesselect(id){
        $('.letter_inbox_right p').css('display','none');
        $('.'+id).css('display','block');
    }

    // 发信箱
    // 所有收信人
    function allsender(){
        $('.letter_outbox_right p').css('display','block');
    }
    // 详细的收信人
    function outselect(id){
        $('.letter_outbox_right p').css('display','none');
        $('.'+id).css('display','block');
    }

    // 发送站内信
    // 提示信息
    $('input').click(function(){
        reminder = $(this).attr('reminder');
        $(this).next('span').html(reminder).css('color','red');

    });
    // 判断账号是否存在
    $('input[name=sender]').blur(function(){
        sender = $(this).val();
        $.get('/lettersender',{sender:sender},function(data){
            if (data==0) {
                $('input[name=sender]').next('span').html('用户名不存在').css('color','red');
                $('input[type=submit]').attr('disabled','true');
            }else{
                $('input[name=sender]').next('span').html('输入正确').css('color','green');
                $('input[type=submit]').removeAttr('disabled');
            }
        })
    })
    // 标题
    $('input[name=title]').blur(function(){
        if ($(this).val()) {
            $(this).next('span').html('输入正确').css('color','green');
            $('input[type=submit]').removeAttr('disabled');
        }else{
            $(this).next('span').html('请输入标题').css('color','red');
            $('input[type=submit]').attr('disabled','true');
        } 
    });
     // 内容
    $('textarea').blur(function(){
        if ($(this).val()) {
            $(this).next('span').html('输入正确').css('color','green');
            $('textarea').removeAttr('disabled');
        }else{
            $(this).next('span').html('请输入内容').css('color','red');
            $('input[type=submit]').attr('disabled','true');
        } 
    });
</script>
@endsection
