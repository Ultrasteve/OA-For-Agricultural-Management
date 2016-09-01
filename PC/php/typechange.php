<?php

     $type=$_GET["type"];
	// $type="xcb";
     $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
	 
     $con->query("SET NAMES 'UTF8'"); 
     mysqli_set_charset($con, "utf8");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $totalstring="";
     $result = $con->query('SELECT zuowupinlei.NAME FROM zuowupinlei WHERE zuowupinlei.P_ID in (SELECT zuowupinzhong.ID FROM zuowupinzhong WHERE zuowupinzhong.NAME="'.$type.'")'); 
     while($arr = $result->fetch_assoc())
	 {
        $totalstring.=$arr["NAME"];
		$totalstring.="+";
     }
	  $newstr = substr($totalstring,0,strlen($resultstring)-1); 
	$totalstring=$newstr;
     echo $totalstring;
?>