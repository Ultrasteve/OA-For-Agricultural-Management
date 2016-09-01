<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/24
 * Time: 9:17
 */
header("Content-type: text/html; charset=utf-8");
  $password=$_POST['password'];
  $username=$_POST['username'];
  $con=new mysqli("localhost","ccc307","cccccc","ccc307");
  if(!$con)
     die("连接失败,错误原因:".$con->error);
  $sql="SELECT COUNT(*) FROM jishuyuanxinxi WHERE ID=$username AND PASSWORD='$password'";
  if(!$result=$con->query($sql))
     echo "连接失败，错误原因:$con->error";
  else{
    if( $row=$result->fetch_array())
        $num=$row[0];
    else
        $num=0;
  }

echo $num;
$result->free();
$con->close();
?>
