<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/9
 * Time: 10:35
 */
header("Content-type: text/html; charset=utf-8");
$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$name=$_POST['name'];
$i=0;

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT * FROM zhongzhihuxinxi  where NAME='$name'";
if(!($result=$con->query($sql)))
    echo $con->errno;
else
 while($row = mysqli_fetch_assoc($result))
 {
    $array[$i]=Array("name"=>$row['NAME'],"sex"=>$row['GENDER'],"id"=>$row['ID_CARD']);
    $i++;

 }

echo json_encode($array)

?>
