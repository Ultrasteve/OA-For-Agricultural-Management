<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/23
 * Time: 10:02
 */
header("Content-type: text/html; charset=utf-8");
$a=$_POST['parameter'];
$con =new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT * FROM tianjianguanlijilu limit ".$a.",1";
if(!$result=$con->query($sql))
    die($con->error);
else{
    $row=$result->fetch_array();
    $array=array(
        "ID"=>$row['ID'],"WEATHER"=>$row['WEATHER'],"ACT"=>$row['ACT'],"U_PRODUCT"=>$row['U_PRODUCT'],
        "AMOUNT"=>$row['AMOUNT'],"U_METHOD"=>$row['U_METHOD'],"U_MACHINE"=>$row['U_MACHINE'],"P_CONDITION"=>$row['P_CONDITION'],
        "PHOTO"=>$row['PHOTO'],"M_POINT"=>$row['M_POINT'],"NOTE"=>$row['NOTE'],"P_DATE"=>$row['P_DATE'], "Z_ID"=>$row['Z_ID']
    );
    echo json_encode($array);
}
$result->free();
$con->close();
?>
