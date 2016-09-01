<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/12
 * Time: 16:28
 */
header("Content-type: text/html; charset=utf-8");
     $way=$_POST['way'];
     $id_number=$_POST['id_number'];
     $id=$_POST['id'];
     $con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
     if (!$con)
     {
            die('Could not connect: ' . mysqli_errno());
     }
if ($way==0)
     $sql="SELECT * FROM zhongzhihuxinxi  where  ID_CARD='$id_number' ";
else
    $sql="SELECT * FROM zhongzhihuxinxi  where  ID=$id ";

	 $result=$con->query($sql);
	 while ($row = mysqli_fetch_assoc($result))
     {
     $array=array("id"=>$row['ID'],"name"=>$row['NAME'],"sex"=>$row['GENDER'],"id_number"=>$row['ID_CARD'],"phone"=>$row['PHONE'],
                  "seachprov"=>$row['PROV'],"seachcity"=>$row['CITY'],"seachdistrict"=>$row['DISTRICT'], "street"=>$row['ADDRESS'],
                  "telephone"=>$row['TELEPHONE'],"family"=>$row['FAMILY_NUM'],"labour_forcen"=>$row['LABOR_NUM'],
                  "credit"=>$row['CREDIT'],"fund"=>$row['M_CONDITION'],"goumai"=>$row['P_BEHAVIOR'],"age"=>$row['AGE']);
	 }
	 echo json_encode($array);
     mysqli_close($con);
?>
