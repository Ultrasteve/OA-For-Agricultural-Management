<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/16
 * Time: 21:34
 */
/*
        id:localStorage.id,
        id_of_jd: $("#id_of_jd").val(),
        address : $("#address").val(),
        area : $("#area").val(),
        rate : $("#rate").val(),
        date : $("#date").val(),
        agreement : $("#agreement").val(),
        surround : $("#surround").val(),
        landform : $("#landform").val(),
        multiples:$("#multiples").val(),
        multipless : $("#multiples").val(),
        multiple : $("#multiple").val(),
        water_source:$("#water_source").val(),
        tuolaji:$("#tuolaji").val()
*/
header("Content-type: text/html; charset=utf-8");
    $id_of_jd=$_POST['id_of_jd'];
    $behavior=$_POST['b'];
    $id=$_POST['id'];
    $ph=$_POST['ph'];
    $address=$_POST['address'];
    $area=$_POST['area'];
    $rate=$_POST['rate'];
    $date=$_POST['date'];
    $agreement=$_POST['agreement'];
    $surround=$_POST['surround'];
    $landform=$_POST['landform'];
    $n_crop=$_POST['n_crop'];
    $p_crop=$_POST['p_crop'];
    $nearby=$_POST['nearby'];
    $water_source=$_POST['water_source'];
    $tuolaji=$_POST['tuolaji'];
    
    $con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
    if (!$con)
    {
        echo '连接失败';
        die();
    }
//$sql="INSERT INTO zhongzhijidixinxi VALUES ($id_of_jd,$ph,$area,'$landform','$water_source','$multiples','$multipless','$multiple','$rate','$surround','$address',$id,'$tuolaji',$agreement,'$date')";
    if($behavior=='insert')
        $sql="INSERT INTO zhongzhijidixinxi VALUES ($id_of_jd,$ph,$area,'$landform','$water_source','$rate','$surround','$address',$id,'$tuolaji',$agreement,'$date','$p_crop','$n_crop','$nearby')";
    else if ($behavior=='update')
        $sql="UPDATE zhongzhijidixinxi SET PH=$ph,SQUARE=$area,LANDFORM='$landform',W_SOURCE='$water_source',P_RATE='$rate',SURROUNDING='$surround',LOCATION='$address',MA_CONDITION='$tuolaji',
          AGREEMENT=$agreement,DATE='$date',N_CROP='$n_crop',P_CROP='$p_crop',NEARBY='$nearby'  WHERE ID='$id_of_jd' ";
    if ($con->query($sql))
        echo 1;
    else{
        echo $con->error;
    }



mysqli_close($con);
?>
