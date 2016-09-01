<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/15
 * Time: 22:39
 */

$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$p_id=$_POST['p_id'];
$i=0;

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}

$sql="SELECT * FROM zuowupinlei WHERE P_ID=".$p_id;
if (!$result=$con->query($sql))
   echo $con->error;
while ($row = $result->fetch_assoc())
{
    $array[$i++]=array("id"=>$row['ID'],"name"=>$row['NAME']);

}

echo json_encode($array);
$result->free();
$con->close();
?>
