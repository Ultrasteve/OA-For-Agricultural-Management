<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/22
 * Time: 17:50
 */
header("Content-type: text/html; charset=utf-8");
$a=$_POST['parameter'];
$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT * FROM goutongjilu limit ".$a.",1";
if(!$result=$con->query($sql))
    die($con->error);
else{
    $row=$result->fetch_array();
    $array=array(
        "ID"=>$row['ID'],"L_ID"=>$row['L_ID'],"PHOTO"=>$row['PHOTO'],"NOTE"=>$row['NOTE'],
        "TIME"=>$row['TIME'],"NAME"=>$row['NAME'],"Z_ID"=>$row['Z_ID']
    );
    echo json_encode($array);
}
$result->free();
$con->close();
?>
