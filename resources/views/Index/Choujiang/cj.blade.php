<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        ul{list-style:none;}
        li{display:inline-block; border:1px solid #000;}
        span{display:inline-block; padding:10px 15px;}
        li .lottery_yeah{background:red;}
        a{text-decoration: none;color: black;}
        
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
    <link rel="stylesheet" href="/static/public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <center>
        <h2>欢迎来到抽奖环节，来试试您的运气吧</h2>
        <h2>您有3次机会</h2>
        <input class="btn btn-bigger" type="button" id="btn" value="抽奖" /> <a class="btn btn-info" href="/">返回首页</a>
        <ul id="la" class="lottery_all" style="width:800px">
            <li><span eid="0" class="lottery_box"><img src="/Home/images/cj/gift0.jpg"></span></li>
            <li><span eid="1" class="lottery_box"><img src="/Home/images/cj/gift2.jpg"></span></li>
            <li><span eid="2" class="lottery_box"><img src="/Home/images/cj/gift8.gif" width="190px" height="170px"></span></li>
            <li><span eid="3" class="lottery_box"><img src="/Home/images/cj/gift4.jpg"></span></li>
            <li><span eid="4" class="lottery_box"><img src="/Home/images/cj/gift8.gif" width="190px" height="170px"></span></li>
            <li><span eid="5" class="lottery_box"><img src="/Home/images/cj/gift8.gif" width="190px" height="170px"></span></li>
            <li><span eid="6" class="lottery_box"><img src="/Home/images/cj/gift5.jpg"></span></li>
            <li><span eid="7" class="lottery_box"><img src="/Home/images/cj/gift6.jpg"></span></li>
            <li><span eid="8" class="lottery_box"><img src="/Home/images/cj/gift8.gif" width="190px" height="170px"></span></li>
        </ul>
        <script type="text/javascript" src="cj.js"></script>
    </center>
</body>
</html>
<script>
    /*
* 抽奖封装对象
* @class LuckyDraw
* @param { Number } 抽奖悬停号码 
* @method LuckyDraw.tigerMac
* @param { Number, Function } 运动步伐间距，回调函数
*
*/
function LuckyDraw( numId ) {
    if ( this instanceof LuckyDraw ) {
        this.rewardId = numId;
        this.timer = null;
    } else {
        return new LuckyDraw( numId );
    }
}

LuckyDraw.prototype.tigerMac = function( iStep, callback ) {
    var speed = 200 / iStep, // 时间间隔
        $luckyItem = $('#la .lottery_box'),
        len = $luckyItem.length,
        index = 0, // 索引值
        _this = this;
        
    $luckyItem.removeClass('lottery_yeah').eq( index ).addClass('lottery_yeah');
    
    this.timer = setInterval(function () {
        if ( index + 1 > len ) {
            index = 0;
            iStep++;
            clearInterval( _this.timer );
            _this.tigerMac( iStep, callback );
        } else {
            if ( iStep >= 6 ) {
                if ( _this.rewardId && $luckyItem.eq( index ).attr('eid') == _this.rewardId ) {
                    $luckyItem.eq( index ).addClass('lottery_yeah');
                    clearInterval( _this.timer );
                    if ( callback && typeof callback === 'function' ) {
                        callback.call( $luckyItem[index] );
                    }
                    return
                }
            }
            index++;
        }
        $luckyItem.removeClass('lottery_yeah').eq(index).addClass('lottery_yeah');
    }, speed)
};

// 抽奖
$('#btn').click(
    (function(){
        var n = 3,
            aLuckyNum = [2, 5, 8],
            oCj = null;
            
        return function() {
            if ( n ) {
                oCj = new LuckyDraw( aLuckyNum[n - 1] );
                n--;
                oCj.tigerMac( 1, function(){
                    if ( Number( $(this).text() ) === 6 ) {
                        alert('恭喜中奖啦！你还有' + n + '次抽奖机会哦！');
                        
                    } else if ( n ) {
                        alert('^ @ ^ 没中奖，加油！你还有' + n + '次抽奖机会哦！');
                        $('h2:nth(1)').html('您还有'+n+'次机会');
                    } else {
                        alert('^ @ ^ 没中奖！谢谢参与');
                        $('h2:nth(1)').html('您没有机会了');
                    }
                } );
                oCj = null;
            }else {
                alert('你没有抽奖机会啦');
            }
        }
    })()
);
</script>