<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/20
 * Time: 20:38
 */
header("Content-type: text/html; charset=utf-8");
$id=$_POST['id'];
$str=$_POST['str'];
$i=0;
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
if($str=='zw')
    $sql="SELECT * FROM zhongzhizuowuxinxi  WHERE zuowubianhao=$id AND FINISH =1";
else
    $sql="SELECT * FROM zhongzhizuowuxinxi  WHERE PE_ID=$id AND FINISH =1";
if($result=$con->query($sql)){
    while ($row = mysqli_fetch_assoc($result))
    {

        $array[$i++]=array("id_of_jidi"=>$row['L_ID'],"name"=>$row['PE_ID'],"types_of_plant"=>$row['P_ID'],"area"=>$row['SQUARE'],"time"=>$row['P_TIME'],
            "row_spacing"=>$row['ZHUJU'],"column_spacing"=>$row['HANGJU'],"plant_way"=>$row['P_METHOD'], "seed_from"=>$row['S_SOURCE'],
            "production_last_season"=>$row['L_PRODUCTION'],"evaluate"=>$row['EVALUATE'],"kinds_of_plant"=>$row['pinlie'],"id_of_zw"=>$row['zuowubianhao']);
    }
    echo json_encode($array);
}
else{
    echo mysqli_error($con);
}
mysqli_close($con);
?>
