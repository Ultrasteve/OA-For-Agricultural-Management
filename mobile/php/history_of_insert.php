<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/24
 * Time: 22:26
 */

header("Content-type: text/html; charset=utf-8");
$username=$_POST['username'];
$id=$_POST['id'];
$name=$_POST['name'];
$type=$_POST['type'];
$con=new mysqli("localhost","ccc307","cccccc","ccc307");
if(!$con)
    die("连接失败,错误原因:".$con->error);
if($type=='jd')
    $sql = "insert into history_of_jd VALUES ('$username',$id)";
else if ($type=='nh')
    $sql = "insert into history_of_nh VALUES ('$username',$id,'$name')";
else
    $sql = "insert into history_of_zw VALUES ('$username',$id)";



   if(!$con->query($sql))
       if($type=='jd')
         echo "insert_of_jd fail：".$con->error."''$id:'$id";
       else
           echo "insert_of_jd succeed";
   $con->close();
?>


?>
