<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/15
 * Time: 9:59
 */
header("Content-type: text/html; charset=utf-8");
   $a=intval($_POST['parameter']);
   $b=$_POST['str'];
   $con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con) {
    die('Could not connect: ' . mysqli_errno($con));
}
if ($b=='jdxx_num_check')
   $sql = 'SELECT COUNT(*) FROM zhongzhijidixinxi  where M_ID = '.$a;
else if ($b=='zzzw_num_check')
    $sql = "SELECT COUNT(*) FROM zhongzhizuowuxinxi where PE_ID =$a AND FINISH=1";
else if ($b=='gtjl_num_check')
    $sql = 'SELECT COUNT(*) FROM goutongjilu ';
else if ($b=='tzck_num_check')
    $sql = 'SELECT COUNT(*) FROM nongzitaizhangjilu ';
else if ($b=='ycl_num_check')
    $sql = 'SELECT COUNT(*) FROM yuguchanliang';
else
    $sql = 'SELECT COUNT(*) FROM tianjianguanlijilu';
if(!($result =$con->query($sql))) {
    echo $con->error;

} else {
    if ($row = mysqli_fetch_array($result)) {
        $total = $row[0];
    } else {
        $total = 0;
    }
    echo $total;
}

mysqli_close($con);



?>
