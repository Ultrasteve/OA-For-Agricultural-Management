<?php

   /*  $type=$_POST["type"];
     $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $totalstring="";
     $result = $mysqli->query('SELECT NAME zuowupinlei WHERE P_ID IN (SELECT P_ID FROM zuowupinzhong WHERE NAME='.$type.')'); 
     while($arr = $result->fetch_assoc())
	 {
        $totalstring.=$arr["NAME"];
		$totalstring.="*";
     }*/
    $totalstring="1*2*3*4*5*6*7*8*9*";
	echo $totalstring;
?>