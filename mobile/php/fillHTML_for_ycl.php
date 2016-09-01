<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/23
 * Time: 22:38
 */
header("Content-type: text/html; charset=utf-8");
$a=$_POST['parameter'];
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT * FROM yuguchanliang limit ".$a.",1";
if(!$result=$con->query($sql))
    die($con->error);
else{
    $row=$result->fetch_array();
    $sql2="select L_ID,PE_ID from zhongzhizuowuxinxi WHERE zuowubianhao=".$row['zwbh'];
    if(!$result2=$con->query($sql2))
        die  ($con->errno);
    else{
        $row2=$result2->fetch_array();
    }
       $array=array(
         "ID"=>$row['ID'],"zwbh"=>$row['zwbh'],"pici"=>$row['pici'],"nh_id"=>$row2['PE_ID'],
          "date"=>$row['date'],"season"=>$row['season'],"amount"=>$row['amount']);
    echo json_encode($array);
}
$result->free();
$con->close();
?>
