<?php

//id=$_GET['id'];
//$pwd=$_GET['pwd'];
//name=$_GET['name'];
$id=time();
$pwd="456123";
$name="周敏";

if(!empty($id))
{
$a=@new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
if(!$a)
   echo "failed";
else
   echo "success";

$sql="SELECT * FROM jishuyuanxinxi WHERE id='$id'";
$rs=$a->query($sql);
if($rs&&$rs->num_rows>0)
{
   echo "<font color='red' size='4' >该用户名已被注册，请换一个重试!</font><br>\n";
}

else
{
   $sql="INSERT INTO jishuyuanxinxi(id,password,name,level)VALUES";
   $sql .="('$id','$pwd','$name',1)";
   $rs=$a->query($sql);
   if(!$rs)
    {
       $a->close();
       echo'error';
       exit;
    }
    echo"<font color='red' size='4'>success</font><br>\n";
}

$a->close();

}
?>


<?php
if(!empty($id))
{
    echo "用户账号:$id<br>\n";
    echo "密码:$pwd <br>\n";
    echo "用户名:$name<br>\n";
}

?>