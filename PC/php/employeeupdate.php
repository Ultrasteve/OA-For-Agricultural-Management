<?php
     //$con = @new mysqli("localhost","root","root","nongye");
     $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");//连接数据库,需要换成对应的主机名,用户名,密码,数据库名 
	 
	 if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $tablename="jishuyuanxinxi";
	 
		$con->query("SET NAMES 'UTF8'"); 
		mysqli_set_charset($con, "utf8");
	    $input1=$_GET["input1"];
	    $input2=$_GET["input2"];
	    $input3=$_GET["input3"];
	   //$input1=2012;
	  // $input2="abcd";
	  // $input3="xcb"	 
		$result = $con->query('UPDATE '.$tablename.' SET  NAME="'.$input2.'"  WHERE ID='.$input1.'');	
		$result = $con->query('UPDATE '.$tablename.' SET   PASSWORD='.$input3.'  WHERE ID='.$input1.'');
	 
	
?>

<?php
header("Location: http://cc307cc.hk156.ip.hl.cn/%E7%94%B5%E8%84%91/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE%20%E6%96%87%E6%A1%A3%E4%BF%AE%E6%94%B9%E7%89%88/employee.html#");
exit();
?>