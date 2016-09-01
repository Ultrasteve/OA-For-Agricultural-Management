<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/15
 * Time: 22:39
 */
header("Content-type: text/html; charset=utf-8");
$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$i=0;
if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}

$sql="SELECT * FROM zuowupinzhong ";
$result=$con->query($sql);

while ($row = mysqli_fetch_assoc($result))
{
    $array[$i++]=array("id"=>$row['ID'],"name"=>$row['NAME']);

}
echo json_encode($array);

mysqli_close($con);
?>
