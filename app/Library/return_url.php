<?php
//获取订单id
$redis=new Redis();
$redis->connect("localhost",6379);
$order_id=$redis->get('o2o30movieid');
$pdo=new PDO("mysql:host=localhost;dbname=dy","root","");
$pdo->exec("set names utf8");
$static=0;//改变支付状态为0
$buy_time=time();//支付时间
$sql="update morder set static='{$static}',buy_time='{$buy_time}' where id={$order_id}";
//返回预处理
$list=$pdo->prepare($sql);
//执行sql
$list->execute();
//获取受要影响行数
$num=$list->rowCount();
if($num>0){
    echo "支付成功";
}