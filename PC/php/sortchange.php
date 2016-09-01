<?php

     $type=$_GET["type"];
	 $pinlei=$_GET["sort"];
	 //$sort=$_GET["sort"];
	// $sort="meirengua";
     $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
	 $con->query("SET NAMES 'UTF8'"); 
     mysqli_set_charset($con, "utf8");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $totalstring="";
     $result = $con->query('SELECT DISTINCT yuguchanliang.pici
FROM zuowupinlei, yuguchanliang, zhongzhizuowuxinxi
WHERE zhongzhizuowuxinxi.zuowubianhao = yuguchanliang.zwbh
AND zhongzhizuowuxinxi.pinlie = zuowupinlei.ID
AND  zuowupinlei.NAME="'.$pinlei.'"    '); 
     while($arr = $result->fetch_assoc())
	 {
        $totalstring.=$arr["pici"];
		$totalstring.="+";
     }
	  $newstr = substr($totalstring,0,strlen($resultstring)-1); 
	$totalstring=$newstr;
     echo $totalstring;echo "++++++++++++";
?>