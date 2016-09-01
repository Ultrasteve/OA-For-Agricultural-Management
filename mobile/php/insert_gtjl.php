<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/21
 * Time: 22:28
 */

header("Content-type: text/html; charset=utf-8");
$jdbh=$_POST['jdbh'];
$jlbh=$_POST['jlbh'];
$zwbh=$_POST['zwbh'];
$date=$_POST['date'];
$xxxx=$_POST['xxxx'];
$file=$_FILES['file'];
$name=$file['name'];
$type=$file['type'];
$size=$file['size'];
$tmpfile=$file['tmp_name']; //临时存放文件搜索
$error=$file['error'];

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
        die("请选择gif,jpg,png格式图片上传！</br>");
    $myfile="../../../pic/" . $name;
    if(move_uploaded_file($tmpfile,$myfile))
        echo "上传成功</br>";
    else
        die("上传失败</br>") ;


    $sql="INSERT INTO goutongjilu VALUES ($jlbh,$jdbh,'$name','$xxxx','$date','陆家键',$zwbh)";
    if(!$result=$con->query($sql))
        echo "数据插入失败,失败码：".$con->error;
?>

