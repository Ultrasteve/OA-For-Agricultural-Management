<?php
     $currentpage=$_GET['CP'];
	 $tablename=$_GET['TN'];
	 $requestValue=$_GET['VALUE'];
	 $requestKey=$_GET['KEY'];
	 $mode=$_GET['MODE'];
	 //$currentpage=2;$mode=1;$tablename="zhongzhihuxinxi";$requestValue="*";$requestKey="*";
	 require_once "fanyi/".$tablename."fanyi.php";
	 if($requestValue!='*')
	    $requestKey=$xiala[$requestKey];
	 $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
	//$con = @new mysqli("localhost","root","root","nongye");
     if (!$con)
     {
            die('Could not connect: ' . mysql_error());
     }
	 
	 /*刚打开页面  此时currentpage=1  requestValue=*  mode=0*/
	 if($currentpage==1&&$mode==0&&$requestValue=='*')
	 {
		$result = $con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1 ');
		$tables3=array();
        while($arr = $result->fetch_assoc())
	    {
            $tables3[]=$arr;//遍历查询结果
        }
		$row=count($tables3,0);
	    $result = $con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1');
		if($row%6==0)
		   $totalpage=$row/6;
		else
		   $totalpage=ceil($row/6);
	    if($row>$currentpage*6)
	    {
	        $result=$con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1  limit '.(($currentpage-1)*6).' , 6');
			$resultstring=$totalpage.'*'; 
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	             $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];
					$resultstring.='+';
		        }
				$newstr = substr($resultstring,0,strlen($resultstring)-1); 
		        $resultstring=$newstr;
		        $resultstring.='#';
	        }
			$newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	    else
	    { 
	        $result=$con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1  limit '.(($currentpage-1)*6).' , 6'); 
			$resultstring=$totalpage.'*'; //echo $resultstring;
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
			   echo $arr->num_rows;
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	             $resultstring.=$xiala[$column[$k]];
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<2;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	 }
	 
	 if($mode==1&&$requestValue=='*')/*翻页  currentpage＝“翻页后的页码”  mode=1*/
	 {
		$resultstring="";
        $result = $con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1');
		$tables3=array();
        while($arr = $result->fetch_assoc())
	    {
            $tables3[]=$arr;//遍历查询结果
        }
		$row=count($tables3,0);
	    $result = $con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1');
	    if($row>$currentpage*6)
	    {  
	        $result=$con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1  limit '.(($currentpage-1)*6).' , 6');
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	    else
	    { 
	        $result=$con->query('SELECT * FROM '.$tablename.' WHERE LEVEL=1  limit  '.(($currentpage-1)*6).' , 6'); 
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	 }
	 if($currentpage==1&&$mode==0&&$requestValue!='*')/*查询导致的页面更新currentpage=1 requestValue="用户输入的内容" requestKey="用户选择的内容"  mode=0*/
	 {
	    $result = $con->query('SELECT * FROM '.$tablename.'  where '.$requestKey.'  ='.$requestValue.' and  LEVEL=1 ');
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
	        $result=$con->query('SELECT * FROM '.$tablename.'  where '.$requestKey.'  ='.$requestValue.' and LEVEL=1 limit '.(($currentpage-1)*6).', 6');
			$resultstring=$totalpage.'*'; 
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	    else
	    {   
	        $result=$con->query('SELECT * FROM '.$tablename.'  where '.$requestKey.'  ='.$requestValue.'  and LEVEL=1 limit '.(($currentpage-1)*6).' , 6'); 
			$resultstring=$totalpage.'*'; //echo $resultstring;
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	 }
	 if($mode==1&&$requestValue!='*')/*查询导致的页面翻页 currentpage=‘’ requestValue="用户输入的内容" requestKey="用户选择的内容"  mode=0*/
	 {
	    $result = $con->query('SELECT * FROM '.$tablename.' where '.$requestKey.'  ='.$requestValue.' and LEVEL=1');
		$tables3=array();
        while($arr = $result->fetch_assoc())
	    {
            $tables3[]=$arr;//遍历查询结果
        }
		$row=count($tables3,0);
	    if($row>$currentpage*6)
	    {
	        $result=$con->query('SELECT * FROM '.$tablename.'  where '.$requestKey.'  ='.$requestValue.' and  LEVEL=1  limit '.(($currentpage-1)*6).', 6');
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	    else
	    {   
	        $result=$con->query('SELECT * FROM '.$tablename.'  where '.$requestKey.'  ='.$requestValue.' and LEVEL=1 limit '.(($currentpage-1)*6).' , 6'); 
			$tables=array();
            while($arr = $result->fetch_assoc())
	        {
               $tables[]=$arr;//遍历查询结果
            }
            $result = $con->query('DESCRIBE '.$tablename.'');//table_name 换成你对应的表名
            $column=array();
            while($arr = $result->fetch_assoc())
	        {
               $column[]=$arr["Field"];
            }
	        $j=count($tables,0);
			for($k=0;$k<count($column,1)-1;$k++)
		    {
	              $resultstring.=$xiala[$column[$k]];	
			     $resultstring.='+';
		    }
		    $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		    $resultstring.='*';
	        for($i=0;$i<$j;$i++)
	        {
		        for($k=0;$k<count($column,1)-1;$k++)
		        {
	                $resultstring.=$tables[$i][$column[$k]];	
					$resultstring.='+';
		        }
				 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
		        $resultstring.='#';
	        }
			 $newstr = substr($resultstring,0,strlen($resultstring)-1); 
		    $resultstring=$newstr;
			echo $resultstring;
	    }
	 }
	 
	 $con->close;

?>