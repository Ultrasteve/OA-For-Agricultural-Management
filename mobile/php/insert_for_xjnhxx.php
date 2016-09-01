<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/13
 * Time: 16:00
 */
       /* name:$("#name").val(),
        sex: $("#sex").val(),
        id_number : $("#id_number").val(),
        phone_number : $("#phone_number").val(),
        city : $("#seachcity").val(),
        district : $("#seachdistrict").val(),
        province : $("#seachprov").val(),
        street : $("#street").val(),
        family : $("#family_number").val(),
        worker:$("#worker_number").val(),
        credit : $("#credit").val(),
        fund : $("#fund").val()*/
header("Content-type: text/html; charset=utf-8");
$age=$_POST['age'];
$goumai=$_POST['goumai'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$id_number=$_POST['id_number'];
$phone_number=$_POST['phone_number'];
$city=$_POST['city'];
$district=$_POST['district'];
$province=$_POST['province'];
$street=$_POST['street'];
$family=$_POST['family'];
$worker=$_POST['worker'];
$credit=$_POST['credit'];
$fund=$_POST['fund'];
$telephone=$_POST['telephone'];
$id=time();

$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con)
{
    echo '连接失败';
    die();
}
$sql="INSERT INTO zhongzhihuxinxi VALUES ($id,'$name','$sex','$id_number','$phone_number','$telephone','$street',$province,$city,$district,$family,$worker,$credit,$fund,'$goumai',$age)";

if ($con->query($sql))
    echo $id;
else
    echo  $con->error.$id;

mysqli_close($con);
?>
