<?php

	 $pinzhong=$_GET["one"];
	 $pinlei=$_GET["two"];
	 $dengji=$_GET["three"];
	 $prov=$_GET["four"];
	 $city=$_GET["five"];
	 $street=$_GET["six"];
	 $time1=$_GET["seven"];
	 $time2=$_GET["eight"];
	/*$pinzhong="";
	 $pinlei="";
	 $dengji=" ";
	 $prov="广东省";
	 $city=" ";
	 $street=" ";
	 $time1="";
	 $time2="";*/
	 if($pinzhong==" ")
	    $pinzhong="";
		if($pinlei==" ")
	    $pinlei="";
		if($dengji==" ")
	    $dengji="";
		if($prov==" ")
	    $prov="";
		if($city==" ")
	    $city="";
		if($street==" ")
	    $street="";
	 $pinzhong2="%".$pinzhong."%";
	 $pinlei2="%".$pinlei."%";
	 $dengji2="%".$dengji."%";
	 if($time1=="")
	    $time1="1900-01-01";
	 if($time2=="")
	    $time2="2100-12-12";
	 $dizhi="%".$prov.$city.$street."%";
	 $currentpage=1;
	
	 $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 $con->query("SET NAMES 'UTF8'"); 
     mysqli_set_charset($con, "utf8");
	 
	 /*刚打开页面 */
	 $sql='';
	    if($pinzhong=="")
		{
			$sql='SELECT  distinct yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID     and yuguchanliang.date>"'.$time1.'" and yuguchanliang.date<"'.$time2.'" and zhongzhijidixinxi.LOCATION LIKE "'.$dizhi.'"';	
			
		}
		if($pinlei==""&&$pinzhong!="")
		{
			$sql='SELECT   distinct yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zuowupinlei,zuowupinzhong,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and   zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID and zhongzhizuowuxinxi.pinlie=zuowupinlei.ID  and zhongzhizuowuxinxi.P_ID=zuowupinzhong.ID and zuowupinzhong.NAME LIKE "'.$pinzhong2.'"   and yuguchanliang.date>"'.$time1.'" and yuguchanliang.date<"'.$time2.'" and zhongzhijidixinxi.LOCATION LIKE "'.$dizhi.'"';
		}
		if($pinlei!="")
		{
			$sql='SELECT  distinct yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zuowupinlei,zuowupinzhong,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID and zhongzhizuowuxinxi.pinlie=zuowupinlei.ID and zuowupinlei.NAME LIKE "'.$pinlei2.'"  and yuguchanliang.pici LIKE "'.$dengji2.'"  and yuguchanliang.date>"'.$time1.'" and yuguchanliang.date<"'.$time2.'" and zhongzhijidixinxi.LOCATION LIKE "'.$dizhi.'"';
			
		}
		$result = $con->query($sql);
		$tables3=array();
        while($arr = $result->fetch_assoc())
	    {
            $tables3[]=$arr;//遍历查询结果
        }
		$row=count($tables3,0);
		if($row%6==0)
		   $totalpage=$row/6;
		else
		   $totalpage=ceil($row/6);
	    if($row>$currentpage*6)
	    { 
	        $result=$con->query($sql.'  limit 0,6');
			$resultstring=$totalpage.'/'; 
			$tables=array();
            while($arr = $result->fetch_assoc())//遍历查询结果
	        {
              // $resultstring.=$arr["ID1"];$resultstring.="+";
			   $resultstring.=$arr["zwbh"];$resultstring.="+";
			   $resultstring.=$arr["amount"];$resultstring.="+";
			   $resultstring.=$arr["ID2"];$resultstring.="+";
			   $resultstring.=$arr["ID3"];$resultstring.="+";
			   $resultstring.=$arr["NAME"];$resultstring.="+";
			   $resultstring.=$arr["TELEPHONE"];$resultstring.="+";
			   $resultstring.=$arr["GENDER"];$resultstring.="+";
			   $resultstring.=$arr["AGE"];$resultstring.="+";
			   $resultstring.=$arr["ADDRESS"];$resultstring.="#";
            }
           $resultstring.="/"; 
		   $resultstring.=$sql;
			echo $resultstring;
	    }
	    else
	    {   
	        $result=$con->query($sql.'  limit 0,6'); 
			$resultstring=$totalpage.'/'; 
            while($arr = $result->fetch_assoc())
	        {
                  //  $resultstring.=$arr["ID1"];$resultstring.="+";
			   $resultstring.=$arr["zwbh"];$resultstring.="+";
			   $resultstring.=$arr["amount"];$resultstring.="+";
			   $resultstring.=$arr["ID2"];$resultstring.="+";
			   $resultstring.=$arr["ID3"];$resultstring.="+";
			   $resultstring.=$arr["NAME"];$resultstring.="+";
			   $resultstring.=$arr["TELEPHONE"];$resultstring.="+";
			   $resultstring.=$arr["GENDER"];$resultstring.="+";
			   $resultstring.=$arr["AGE"];$resultstring.="+";
			   $resultstring.=$arr["ADDRESS"];$resultstring.="#";
		       } 
	        $newstr = substr($resultstring,0,strlen($resultstring)-1); 
	        $resultstring=$newstr;
			$resultstring.="/";
		    $resultstring.=$sql;
			echo $resultstring;
	 }
	 $con->close;



?>