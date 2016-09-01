<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/22
 * Time: 23:15
 */
header("Content-type: text/html; charset=utf-8");
        $ID=time();
        $NAME=$_POST['NAME'];
        $PACK=$_POST['PACK'];
        $P_DATE=$_POST['P_DATE'];
        $PRICE=$_POST['PRICE'];
        $AMOUNT=$_POST['AMOUNT'];
        $T_PRICE=$_POST['T_PRICE'];
        $PRODUCER=$_POST['PRODUCER'];
        $P_LOCATION=$_POST['P_LOCATION'];
        $STORAGE=$_POST['STORAGE'];
        $NOTE=$_POST['NOTE'];
        $N_NOTE=$_POST['N_NOTE'];
        $MAIN_C=$_POST['MAIN_C'];
        $USAGE=$_POST['USAGE'];
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con)  die('连接失败');
$sql="INSERT INTO nongzitaizhangjilu VALUES ($ID,'$NAME','$PACK','$P_DATE',$PRICE,$AMOUNT,
      $T_PRICE,'$PRODUCER','$P_LOCATION',$STORAGE,'$NOTE',$N_NOTE,'$MAIN_C','$USAGE')";

if ($con->query($sql))
    echo 1;
else
    echo  $con->error;

?>
