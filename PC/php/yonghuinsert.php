<?php
      $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");//连接数据库,需要换成对应的主机名,用户名,密码,数据库名
   //  $tablename=$_GET["input0"];
	 $tablename="jishuyuanxinxi";

		//$con->query("SET NAMES 'UTF8'"); 
		//mysqli_set_charset($con, "utf8");
	    $input1=$_GET["input1"];
	    $input2=$_GET["input2"];
	    $input3=$_GET["input3"];
		$input4=$_GET["input4"];
	   //$input1=11;
	   //$input2="富士苹果";
	  // $P_NAME="xcb";
	 
		$result = $con->query('INSERT INTO '.$tablename.' (ID,NAME,PASSWORD,LEVEL) VALUES ('.$input1.',"'.$input2.'",'.$input3.','.$input4.') ');
	
?>