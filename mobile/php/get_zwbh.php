<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/28
 * Time: 22:52
 */
header("Content-type: text/html; charset=utf-8");
$a=$_POST['jdbh'];
$i=0;
$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}
$sql="SELECT zuowubianhao FROM zhongzhizuowuxinxi  WHERE  L_ID=$a";
if(!$result=$con->query($sql))
    die($con->error);
else{
    while ($row=$result->fetch_array())
        $array[$i++]=array("zwbh"=>$row['zuowubianhao']);
    
}


echo  json_encode($array);
$result->free();
$con->close();


?>
