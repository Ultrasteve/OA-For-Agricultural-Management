<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/16
 * Time: 10:21
 */
header("Content-type: text/html; charset=utf-8");
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$id= intval($_POST['id']);
$str=$_POST['str'];



if (!$con)
{
 die('Could not connect: ' . mysqli_errno());
}
if($str=='jdxx_num_check')
     $sql="SELECT COUNT(*) FROM zhongzhijidixinxi WHERE M_ID=$id";
elseif($str=='jdxx_num_check2')
    $sql="SELECT COUNT(*) FROM zhongzhijidixinxi WHERE ID=$id";
elseif ($str=='zzzw_num_check')
    $sql="SELECT COUNT(*) FROM zhongzhizuowuxinxi WHERE PE_ID=$id AND FINISH=1";
elseif ($str=='zzzw_num_check2')
    $sql="SELECT COUNT(*) FROM zhongzhizuowuxinxi WHERE zuowubianhao=$id AND FINISH=1";
else if($str=='tjglxx_num_check')
    $sql="SELECT COUNT(*) FROM tianjianguanlijilu";
else
     $sql="SELECT COUNT(*) FROM zhongzhihuxinxi WHERE ID=$id";

if(!$result=$con->query($sql))
    echo $con->error;
else {
    if ($row = $result->fetch_row()) {
        $total = $row[0];
    } else {
        $total = 0;
    }
    echo $total;
}
mysqli_close($con);





?>
