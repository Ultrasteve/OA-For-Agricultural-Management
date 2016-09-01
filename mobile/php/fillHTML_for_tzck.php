<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/22
 * Time: 22:53
 */
header("Content-type: text/html; charset=utf-8");
$a=$_POST['parameter'];
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT * FROM nongzitaizhangjilu limit ".$a.",1";
if(!$result=$con->query($sql))
    die($con->error);
else{
    $row=$result->fetch_array();
    $array=array(
        "ID"=>$row['ID'],"NAME"=>$row['NAME'],"PACK"=>$row['PACK'],"P_DATE"=>$row['P_DATE'],
        "PRICE"=>$row['PRICE'],"AMOUNT"=>$row['AMOUNT'],"T_PRICE"=>$row['T_PRICE'],"PRODUCER"=>$row['PRODUCER'],
        "P_LOCATION"=>$row['P_LOCATION'],"STORAGE"=>$row['STORAGE'],"NOTE"=>$row['NOTE'],"N_NOTE"=>$row['N_NOTE'],
        "MAIN_C"=>$row['MAIN_C'],"USAGE"=>$row['USAGE']
    );
    echo json_encode($array);
}
$result->free();
$con->close();
?>
