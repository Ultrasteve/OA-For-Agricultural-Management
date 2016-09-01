<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/21
 * Time: 9:57
 */
header("Content-type: text/html; charset=utf-8");
  $a=$_POST['id'];
  $str=$_POST['b'];
  $i=0;
  $con=new mysqli("103.226.154.156","ccc307","cccccc","ccc307");

  if (!$con)
      die('Could not connect: ' . mysqli_errno());
  if ($str=='zzzw')
      $sql="SELECT ID,N_CROP FROM zhongzhijidixinxi WHERE M_ID=".$a;
  else
      $sql="SELECT ID,N_CROP FROM zhongzhijidixinxi WHERE M_ID=".$a."  AND ID NOT IN(SELECT L_ID FROM zhongzhizuowuxinxi WHERE PE_ID=$a AND FINISH=1)";
  if(!$result=$con->query($sql))
      echo $con->error;
  else {
      while ($row=$result->fetch_assoc())
      {
            $array[$i++]=array("id_of_jidi"=>$row['ID'],"types_of_plant"=>$row['N_CROP']);
      }
  }
  echo json_encode($array);
mysqli_close($con);
?>
