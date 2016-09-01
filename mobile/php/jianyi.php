<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/28
 * Time: 21:07
 */
$con=new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$text=$_POST['text'];
$username=$_POST['username'];
$sql="insert into suggest (username,content) VALUES ($username,'$text')";
if(!$con->query($sql))
   die($con->error);
else
   die("1");
?>
