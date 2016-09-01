<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/15
 * Time: 21:18
 */
header("Content-type: text/html; charset=utf-8");
$str=$_POST['str'];
$id=$_POST['id'];
$i=0;
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
if($str=='jd')
    $sql="select * from zhongzhijidixinxi WHERE ID=$id";
else{
    $sql="SELECT * FROM zhongzhijidixinxi WHERE M_ID=$id";
}

if($result=$con->query($sql)){
   while ($row = $result->fetch_assoc())
   {

      $array[$i++]=array("nhbh"=>$row['M_ID'],"id"=>$row['ID'],"address"=>$row['LOCATION'],"area"=>$row['SQUARE'],"rate"=>$row['P_RATE'],
        "date"=>$row['DATE'],"agreement"=>$row['AGREEMENT'],"surround"=>$row['SURROUNDING'], "landform"=>$row['LANDFORM'],
        "p_crop"=>$row['P_CROP'],"n_crop"=>$row['N_CROP'],"water_source"=>$row['W_SOURCE'],"ph"=>$row['PH'],
        "tuolaji"=>$row['MA_CONDITION'],"nearby"=>$row['NEARBY']);
   }
   echo json_encode($array);
}
else{
    echo mysqli_errno($con);
}
mysqli_close($con);
?>
