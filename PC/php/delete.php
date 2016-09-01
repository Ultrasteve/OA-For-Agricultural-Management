<?php
     $mysqli = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");//连接数据库,需要换成对应的主机名,用户名,密码,数据库名
	 $ID=$_GET["ID"];
     $tablename=$_GET["TN"];
	 $result = $mysqli->query('DELETE FROM '.$tablename.' WHERE ID='.$ID.'');
?>