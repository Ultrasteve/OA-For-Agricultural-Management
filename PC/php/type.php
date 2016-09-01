<?php

     $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
	 $con->query("SET NAMES 'UTF8'"); 
     mysqli_set_charset($con, "utf8");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $totalstring="";
     $result = $con->query('SELECT * FROM zuowupinzhong');//table_name 换成你对应的表名
     $column=array();
     while($arr = $result->fetch_assoc())
	 {
        $totalstring.=$arr["NAME"];
		$totalstring.="+";
     }
	  $newstr = substr($totalstring,0,strlen($resultstring)-1); 
	$totalstring=$newstr;
	 echo $totalstring;
?>