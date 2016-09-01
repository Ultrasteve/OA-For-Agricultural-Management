<?php
      $con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");//连接数据库,需要换成对应的主机名,用户名,密码,数据库名
   //  $tablename=$_GET["input0"];
	 $tablename="zuowupinlei";
	 if($tablename=="zuowupinlei")
	 {
		//$con->query("SET NAMES 'UTF8'"); 
		//mysqli_set_charset($con, "utf8");
	    $input1=time();
	    $input2=$_GET["input2"];
	    $input3=$_GET["input3"];
	   //$input1=11;
	   //$input2="富士苹果";
	  // $P_NAME="xcb";
	   $P_NAME=$input3;
	 $result = $con->query('SELECT * FROM zuowupinzhong  where NAME  ="'.$P_NAME.'"');
	  $arr = $result->fetch_assoc();
       $P_ID=$arr["ID"];
	 
		$result = $con->query('INSERT INTO '.$tablename.' (ID,NAME,P_ID) VALUES ('.$input1.',"'.$input2.'",'.$P_ID.') ');
	 }
	 if($tablename=="zhongzhihu")
	 {
	    $input1=$_GET["input1"];
	    $input2=$_GET["input2"];
	    $input3=$_GET["input3"];
	    $input4=$_GET["input4"];
		$input5=$_GET["input5"];
		$input6=$_GET["input6"];
		$input7=$_GET["input7"];
	    $input8=$_GET["input8"];
	    $input9=$_GET["input9"];
	    $input10=$_GET["input10"];
		$input11=$_GET["input11"];
		$input12=$_GET["input12"];
		$input13=$_GET["input13"];
	    $input14=$_GET["input14"];
	    $input15=$_GET["input15"];
		$input16=$_GET["input16"];
        $result = $con->query('INSERT INTO '.$tablename.' (ID,NAME,GENDER,ID_CARD,PHONE,TELEPHONE,ADDRESS,PROV,CITY,DISTRICT,FAMILY_NUM,LABOR_NUM,CREDIT,M_CONDITION,P_BEHAVIOR,AGE) VALUES ('.$input1.','.$input2.','.$input3.','.$input4.','.$input5.','.$input6.','.$input7.','.$input8.','.$input9.','.$input10.','.$input11.','.$input12.','.$input13.','.$input14.','.$input15.','.$input16.') ');
	
     }
	 if($tablename=="zhongzhijidixinxi")
	 {
		 $input1=$_GET["input1"];
	    $input2=$_GET["input2"];
	    $input3=$_GET["input3"];
	    $input4=$_GET["input4"];
		$input5=$_GET["input5"];
		$input6=$_GET["input6"];
		$input7=$_GET["input7"];
	    $input8=$_GET["input8"];
	    $input9=$_GET["input9"];
	    $input10=$_GET["input10"];
		$input11=$_GET["input11"];
		$input12=$_GET["input12"];
		$input13=$_GET["input13"];
	    $input14=$_GET["input14"];
	    $input15=$_GET["input15"];
		$input16=$_GET["input16"];
        $result = $con->query('INSERT INTO '.$tablename.' (ID,PH,SQUARE,LANDFORM,W_SOURCE,P_HISTORY,ADDRESS,PROV,CITY,DISTRICT,FAMILY_NUM,LABOR_NUM,CREDIT,M_CONDITION,P_BEHAVIOR,AGE) VALUES ('.$input1.','.$input2.','.$input3.','.$input4.','.$input5.','.$input6.','.$input7.','.$input8.','.$input9.','.$input10.','.$input11.','.$input12.','.$input13.','.$input14.') ');
	 }
	 if($tablename=="tianjianguanlijiluxinxi")
	 {
		 
	 }
	 if($tablename=="goutongjilu")
	 {
		 
	 }
	 if($tablename=="yuguchanliang")
	 {
		$zhongzhidi=$_GET["input1"];
	    $pinzhong=$_GET["input2"];
	    $zhongzhihu=$_GET["input3"];
	    $yuchanqi=$_GET["input4"];
		$zuowu=$_GET["input5"];
		$yuchanliang=$_GET["input6"];
		$result = $con->query('INSERT INTO '.$tablename.' (L_ID,PI_ID,PE_ID,FP,P_ID,P_AMOUT) VALUES ('.$input1.','.$input2.','.$input3.','.$input4.','.$input5.','.$input6.') ');
	 }
?>