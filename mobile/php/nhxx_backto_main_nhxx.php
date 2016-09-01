<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/12
 * Time: 22:54
 */
/* id:$("#id").val(),
        name:$("#id").val(),
        sex:$("#id").val(),
        id_number:$("#id_number").val(),
        phone:$("#phone").val(),
        seachprov:$("#seachprov").val(),
        seachcity:$("#seachcity").val(),
        seachdistrict:$("#seachdistrict").val(),
        street:$("#street").val(),
        telephone:$("#telephone").val(),
        family:$("#family").val(),
        labour_forcen:$("#labour_forcen").val(),
        credit:$("#credit").val(),
        fund:$("#fund").val()*/
header("Content-type: text/html; charset=utf-8");
$id=$_POST['id'];
$age=$_POST['age'];
$goumai=$_POST['goumai'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$id_number=$_POST['id_number'];
$phone=$_POST['phone'];
$city=$_POST['seachcity'];
$district=$_POST['seachdistrict'];
$province=$_POST['seachprov'];
$street=$_POST['street'];
$family=$_POST['family'];
$worker=$_POST['labour_forcen'];
$credit=$_POST['credit'];
$fund=$_POST['fund'];
$telephone=$_POST['telephone'];
$con = @new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con)
{
    echo '连接失败';
    die();
}
$sql="UPDATE zhongzhihuxinxi SET NAME =$name,GENDER =$sex,ID_CARD=$id_number,PHONE=$phone_number,TELEPHONE=$telephone,
                                  ADDRESS=$street,PROV=$province,CITY=$city,DISTRICT=$district,FAMILY_NUM=$family,LABOR_NUM=
                                  $worker,CREDIT=$credit,M_CONDITION=$fund,P_BEHAVIOR=$goumai,AGE=$age) WHERE ID=$id";

if ($con->query($sql))
    echo 1;
else
    echo  0;

mysqli_close($con);
?>

