<?php

     $currentpage=$_GET["CP"];
	 $sql=$_GET["sql"];
	 $amount=$_GET["amount"];
	 $size=$_GET["size"];
	//$currentpage=1;$sql='*';
	//$amount=-1;$size="";
	
	 $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
	//$con = @new mysqli("localhost","root","root","nongye");
	// $con->query("SET NAMES 'UTF8'"); 
    // mysqli_set_charset($con, "utf8");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 
	 /*刚打开页面  此时currentpage=1  requestValue=*  没两个筛选不翻页*/
	 if($sql=='*')
	 {
		$result = $con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID    ');
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
	        $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID  limit '.(($currentpage-1)*6).' , 6' );
			$resultstring=$totalpage.'*'; 
			$tables=array();
            while($arr = $result->fetch_assoc())//遍历查询结果
	        {
               //$resultstring.=$arr["ID1"];$resultstring.="+";
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
			echo $resultstring;
	    }
	    else
	    {   
	         $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID  limit '.(($currentpage-1)*6).' , 6' );
			$resultstring=$totalpage.'*'; 
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
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
		}
		//echo 'SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi where  yuguchanliang.zwbh=zhongzhijidixinxi.NI_ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID';
	}
	
	
	
	if($sql==""&&$amount==-1)/*没两个筛选，翻页*/
	{
		if($currentpage!=1)	
		{
	       $oldsql= 'SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID  ' ; 
		   $result=$con->query($oldsql.'   limit '.(($currentpage-1)*6).' , 6');
            while($arr = $result->fetch_assoc())//遍历查询结果
	        {
               //$resultstring.=$arr["ID1"];$resultstring.="+";
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
			$resultstring.="*";
			$resultstring.=$oldsql;
			echo $resultstring;
		}
		if($currentpage==1)
		{
		   	$result = $con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID    ');
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
	        $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID  limit '.(($currentpage-1)*6).' , 6' );
			$resultstring=$totalpage.'*'; 
			$tables=array();
            while($arr = $result->fetch_assoc())//遍历查询结果
	        {
               //$resultstring.=$arr["ID1"];$resultstring.="+";
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
			echo $resultstring;
	    }
	    else
	    {   
	         $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID  limit '.(($currentpage-1)*6).' , 6' );
			$resultstring=$totalpage.'*'; 
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
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
		}
		}
	}
	
	
	
	 if(($amount!=-1)&&$sql==""&&$currentpage!=1)/*翻页  currentpage＝“翻页后的页码”  只含需求总量的翻页*/
	 {	
	    if($size==1)
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
			if($i>$currentpage*6)
			   $i=6;
			 else
			   $i=$currentpage*6-$i;
			
	            $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC limit '.(($currentpage-1)*6).' ,'.$i.' ');
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
			echo $resultstring;
		}
		if($size==0)
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
			if($i>$currentpage*6)
			   $i=6;
			 else
			   $i=$currentpage*6-$i;
			
	            $result=$con->query('SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount  limit '.(($currentpage-1)*6).' ,'.$i.' ');
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
			echo $resultstring;
		}
	 }
	 
	 
	 
	 if($sql!=""&&$amount!=-1&&$currentpage!=1)//上下均有筛选
	 {
	    if($size==1)
		{
		$result = $con->query($sql.'  GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC  ');
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
			if($i>$currentpage*6)
			   $i=6;
			 else
			   $i=$currentpage*6-$i;
			
	            $result=$con->query($sql.'  GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC limit '.(($currentpage-1)*6).' ,'.$i.' ');
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
			echo $resultstring;
		}
		if($size==0)
		{
		   	$result = $con->query($sql.'  GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC  ');
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
			if($i>$currentpage*6)
			   $i=6;
			 else
			   $i=$currentpage*6-$i;
	            $result=$con->query($sql.'  GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount  limit '.(($currentpage-1)*6).' ,'.$i.' ');
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
			echo $resultstring;
		} 	 
		 
	 }
	
	
	if($sql!=""&&$amount==-1&&$sql!="*"&&$currentpage!=1)/*只有上面的筛选*/
	{
	    	$result = $con->query($sql.'  limit '.(($currentpage-1)*6).',6  ');
			
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
			echo $resultstring;
    }	
	
	
	if(($amount!=-1)&&$sql==""&&$currentpage==1)
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
			    $resultstring=$totalpage.'*'; 
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
                $resultstring.="*";
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
			    $resultstring=$totalpage.'*'; 
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
                $resultstring.="*";
		        $resultstring.='SELECT yuguchanliang.ID as ID1, yuguchanliang.zwbh,yuguchanliang.amount,zhongzhijidixinxi.ID as ID2,zhongzhihuxinxi.ID as ID3,zhongzhihuxinxi.NAME,zhongzhihuxinxi.TELEPHONE,zhongzhihuxinxi.GENDER,zhongzhihuxinxi.AGE,zhongzhihuxinxi.ADDRESS FROM yuguchanliang , zhongzhihuxinxi,zhongzhijidixinxi,zhongzhizuowuxinxi where  yuguchanliang.zwbh=zhongzhijidizuowuxinxi.zuowubianhao   and zhongzhizuowuxinxi.L_ID=zhongzhijidixinxi.ID and zhongzhijidixinxi.M_ID=zhongzhihuxinxi.ID GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount ';
			echo $resultstring;
	   }
   
	}
	
	
	if($sql!=""&&$amount==-1&&$sql!="*"&&$currentpage==1)
	{
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
			$resultstring=$totalpage.'*'; 
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
           $resultstring.="*"; 
		   $resultstring.=$sql;
			echo $resultstring;
	    }
	    else
	    {   
	        $result=$con->query($sql.'  limit 0,6'); 
			$resultstring=$totalpage.'*'; 
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
			$resultstring.="*";
		    $resultstring.=$sql;
			echo $resultstring;	
	}
	}
	
	if($sql!=""&&$amount!=-1&&$currentpage==1)
	{
	      if($size==1)
	   {  
		   $newsql=$sql.' GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount DESC';  
		    $result = $con->query($newsql);
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
				 
			
				$newsql=$sql.' GROUP BY yuguchanliang.ID ORDER BY yuguchanliang.amount DESC limit 0 , '.$i.'';
	            $result=$con->query($newsql);
			    $resultstring=$totalpage.'*'; 
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
                $resultstring.="*";
		        $resultstring.=$sql;
			echo $resultstring;
					 
	   }
	   else
	   {
		   $newsql=$sql.' GROUP BY yuguchanliang.ID  ORDER BY yuguchanliang.amount ';  
		    $result = $con->query($newsql);
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
				 
			
				$newsql=$sql.' GROUP BY yuguchanliang.ID ORDER BY yuguchanliang.amount  limit 0 , '.$i.'';
	            $result=$con->query($newsql);
			    $resultstring=$totalpage.'*'; 
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
                $resultstring.="*";
		        $resultstring.=$sql;
			echo $resultstring;
	   }	
	}
	
	
	
	 $con->close;

?>