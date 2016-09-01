<?php
session_start();
$id=$_GET['username'];
$pwd=$_GET['pwd'];
//name=$_GET['name'];


if($id=="")
    echo "用户账号为空！";
if($pwd=="")
    echo "密码为空！";
	

if(!empty($id))
{
$a=@new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if(!$a)
   echo "failed";
else
   echo "success";

$sql="SELECT * FROM jishuyuanxinxi WHERE ID='$id'";
$rs=$a->query($sql);
if($rs&&$rs->num_rows>0)
{
    $sql="SELECT * FROM jishuyuanxinxi WHERE ID='$id' and PASSWORD='$pwd' and LEVEL=1 ";
    $rs=$a->query($sql);
    if(!$rs)
    {
       $a->close();
       "<font color='red' size='4' >密码不正确！</font><br>\n";
	$_SESSION["errmessage"]="密码不正确！";
	header("Location: http://cc307cc.hk156.ip.hl.cn/%E7%94%B5%E8%84%91/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE%20%E6%96%87%E6%A1%A3%E4%BF%AE%E6%94%B9%E7%89%88/loginpage.php");
       exit;
    }
    $_SESSION["errmessage"]="";
	$_SESSION["username"]=$id;
	$_SESSION["password"]=$pwd;
	header("Location: http://cc307cc.hk156.ip.hl.cn/%E7%94%B5%E8%84%91/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE%20%E6%96%87%E6%A1%A3%E4%BF%AE%E6%94%B9%E7%89%88/planter_info.php");
}

else
{
   echo "<font color='red' size='4' >该用户不存在！</font><br>\n";
   $_SESSION["errmessage"]="该用户不存在！";	
  header("Location: http://cc307cc.hk156.ip.hl.cn/%E7%94%B5%E8%84%91/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE/%E5%86%9C%E4%B8%9A%E9%A1%B9%E7%9B%AE%20%E6%96%87%E6%A1%A3%E4%BF%AE%E6%94%B9%E7%89%88/loginpage.php");
}

$a->close();

}
?>
