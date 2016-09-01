<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/27
 * Time: 21:38
 */
header("Content-type: text/html; charset=utf-8");
$n_password=$_POST['n_password'];
$f_password=$_POST['f_password2'];
$id=$_POST['username'];
$con=new mysqli("localhost","ccc307","cccccc","ccc307");

if(!$con)
    die("连接失败,错误原因:".$con->error);
else
    $sql="update  jishuyuanxinxi set PASSWORD=$f_password WHERE ID=$id AND PASSWORD=$n_password";

if(!$result=$con->query($sql))
    echo "密码错误！";
else{
   echo "修改成功!";
}

$result->free();
$con->close();
?>
