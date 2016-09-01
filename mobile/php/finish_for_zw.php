<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/25
 * Time: 22:04
 */
header("Content-type: text/html; charset=utf-8");
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$id= $_POST['id'];

if (!$con) {
    die('Could not connect: ' . mysqli_errno());
}

  $sql="UPDATE zhongzhizuowuxinxi SET FINISH=0 WHERE zuowubianhao=$id";
  
  if(!$con->query($sql)){
      die($con->error);
  }
  else{
      echo 1;
  }
$con->close();
?>
