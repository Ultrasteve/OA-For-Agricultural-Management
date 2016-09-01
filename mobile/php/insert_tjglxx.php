<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/23
 * Time: 10:14
 */
header("Content-type: text/html; charset=utf-8");
$ID=$_POST['ID'];
$WEATHER=$_POST['WEATHER'];
$ACT=$_POST['ACT'];
$U_PRODUCT=$_POST['U_PRODUCT'];
$AMOUNT=$_POST['AMOUNT'];
$U_METHOD=$_POST['U_METHOD'];
$U_MACHINE=$_POST['U_MACHINE'];
$P_CONDITION=$_POST['P_CONDITION'];
$M_POINT=$_POST['M_POINT'];
$NOTE=$_POST['NOTE'];
$P_DATE=$_POST['P_DATE'];
$Z_ID=$_POST['Z_ID'];
$file=$_FILES['PHOTO'];
$name=$file['name'];
$type=$file['type'];
$size=$file['size'];
$tmpfile=$file['tmp_name']; //临时存放文件搜索
$error=$file['error'];
//echo $ID. " ".$WEATHER." ".$ACT." ".$U_PRODUCT."  ". $AMOUNT." ". $U_METHOD." ". $U_MACHINE." ". $P_CONDITION." ". $M_POINT." ". $NOTE." ". $P_DATE." ". $Z_ID;
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if (!$con)
{
    die('Could not connect: ' . mysqli_errno());
}

if($erro)
    die("上传出现错误</br>");
if($size>60000)
    die("文件不得大于60kb！</br>");
if (($type!= "image/gif") && ($type!= "image/jpeg") && ( $type!= "image/pjpeg") && ( $type!= "image/png"))
    die("请选择gif,jpg,png格式图片上传！</br>图片格式为:$type</br>");
$myfile="../../../pic/" . $name;
if(move_uploaded_file($tmpfile,$myfile))
    echo "上传成功</br>";
else
    die("上传失败</br>") ;


$sql="INSERT INTO tianjianguanlijilu VALUES ($ID,'$WEATHER','$ACT','$U_PRODUCT',$AMOUNT,'$U_METHOD','$U_MACHINE','$P_CONDITION','$name',
                                                '$M_POINT','$NOTE','$P_DATE',$Z_ID)";
if(!$result=$con->query($sql))
    echo "数据插入失败,失败码：".$con->error;
?>

