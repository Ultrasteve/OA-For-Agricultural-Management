<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/23
 * Time: 23:11
 */
header("Content-type: text/html; charset=utf-8");
$id=time();
$zwbh=$_POST['zwbh'];
$pici=$_POST['pici'];
$date=$_POST['date'];
$season=$_POST['season'];
$amount=$_POST['amount'];

$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con)  die('连接失败');
$sql="INSERT INTO yuguchanliang VALUES ($id,$zwbh,'$date','$amount','$season',$pici)";

if ($con->query($sql))
    echo 1;
else
    echo  $con->error;

?>
