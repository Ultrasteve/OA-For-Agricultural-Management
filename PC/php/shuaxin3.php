<?php

   $size=$_GET["size"];
  $amount=$_GET["amount"];
   $oldsql=$_GET["sql"];
 //$size="大";$amount=50;$oldsql="";

 
 $currentpage=1;
   $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
    $con->query("SET NAMES 'UTF8'"); 
     mysqli_set_charset($con, "utf8");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
   
   if($oldsql=="")
   {
	   if($size=="大")
	   {
				$result = $con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC  ');
			 $tables3=array();
			 $i=1;$j=0;
             while($arr = $result->fetch_assoc())
	         {
                  //遍历查询结果
				$j+=$arr["amount"];
				if($j>$amount)
				  {
					  break;  
				  }
				  $i++;
             }
		     $row=$i;
		     if($row%6==0)
		         $totalpage=$row/6;
		     else
		         $totalpage=ceil($row/6);
			if($i>6)
			   $i=6;
			
	            $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC limit 0 ,'.$i.' ');
			    $resultstring=$totalpage.'/'; 
			    $tables=array(); 
                while($arr = $result->fetch_assoc())//遍历查询结果
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
		        $resultstring.='SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhijidizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC';
			echo $resultstring;
			 
			}
	   else//小
	   {
			 $result = $con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount   ');
			 $tables3=array();
			 $i=1;$j=0;
             while($arr = $result->fetch_assoc())
	         {
                  //遍历查询结果
				$j+=$arr["amount"];
				if($j>$amount)
				  {
					  break;  
				  }
				  $i++;
             }
		     $row=$i;
		     if($row%6==0)
		         $totalpage=$row/6;
		     else
		         $totalpage=ceil($row/6);
			if($i>6)
			   $i=6;
			
	            $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount  limit 0 ,'.$i.' ');
			    $resultstring=$totalpage.'/'; 
			    $tables=array();
                while($arr = $result->fetch_assoc())//遍历查询结果
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
		        $resultstring.='SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhijidizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount ';
			echo $resultstring;
	   }
   }
   else
   {
	   if($size=="大")
	   {  
		   $sql=$oldsql.' GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC';  
		    $result = $con->query($sql);
			 $tables3=array();
             $i=1;$j=0;
             while($arr = $result->fetch_assoc())
	         {
                  //遍历查询结果
				$j+=$arr["amount"];
				if($j>$amount)
				  {
					  break;  
				  }
				  $i++;
             }
		     $row=$i;
		     if($row%6==0)
		         $totalpage=$row/6;
		     else
		         $totalpage=ceil($row/6);
			if($i>6)
			   $i=6; 
				 
			
				$sql=$oldsql.' GROUP BY yuguchanliang.ID ORDER BY yuguchanliang.amount DESC limit 0 , '.$i.'';
	            $result=$con->query($sql);
			    $resultstring=$totalpage.'/'; 
			    $tables=array();
                while($arr = $result->fetch_assoc())//遍历查询结果
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
		        $resultstring.=$oldsql.' GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC';
			echo $resultstring;
					 
	   }
	   else
	   {
		   $sql=$oldsql.' GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount ';  
		    $result = $con->query($sql);
			 $tables3=array();
             $i=1;$j=0;
             while($arr = $result->fetch_assoc())
	         {
                  //遍历查询结果
				$j+=$arr["amount"];
				if($j>$amount)
				  {
					  break;  
				  }
				  $i++;
             }
		     $row=$i;
		     if($row%6==0)
		         $totalpage=$row/6;
		     else
		         $totalpage=ceil($row/6);
			if($i>6)
			   $i=6; 
				 
			
				$sql=$oldsql.' GROUP BY yuguchanliang.ID ORDER BY yuguchanliang.amount  limit 0 , '.$i.'';
	            $result=$con->query($sql);
			    $resultstring=$totalpage.'/'; 
			    $tables=array();
                while($arr = $result->fetch_assoc())//遍历查询结果
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
		        $resultstring.=$oldsql;
			echo $resultstring;
	   }
   }
   
?>
