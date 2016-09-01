<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/21
 * Time: 15:51
 */
/*
 *  var obj = {
            b:'insert',
            id_of_jidi: $("#id_of_jidi").val(),
            name:localStorage.id,
            id_of_zw: $("id_of_zw").val(),
            area: $("#area").val(),
            types_of_plant: $("#types_of_plant").val(),
            kinds_of_plant: $("#kinds_of_plant").val(),
            time: $("#time").val(),
            row_spacing: $("#row_spacing").val(),
            column_spacing: $("#column_spacing").val(),
            plant_way: $("#plant_way").val(),
            seed_from: $("#seed_from").val(),
            production_last_season: $("#production_last_season").val(),
            evaluate: $("#evaluate").val()
        }*/
header("Content-type: text/html; charset=utf-8");
$con = new mysqli("103.226.154.156","ccc307","cccccc","ccc307");
$b=$_POST['b'];
$id_of_jidi=$_POST['id_of_jidi'];
$id=$_POST['name'];
$area=$_POST['area'];
$types_of_plant=$_POST['types_of_plant'];
$kinds_of_plant=$_POST['kinds_of_plant'];
$time=$_POST['time'];
$row_spacing=$_POST['row_spacing'];
$column_spacing=$_POST['column_spacing'];
$plant_way=$_POST['plant_way'];
$seed_from=$_POST['seed_from'];
$production_last_season=$_POST['production_last_season'];
$evaluate=$_POST['evaluate'];
$id_of_zw=time();
if (!$con)
{
    echo '连接失败';
    die();
}
if($b=='insert')
    $sql="INSERT INTO zhongzhizuowuxinxi VALUES ($id_of_jidi,$id,$types_of_plant,'$time',$area,$row_spacing,$column_spacing,'$plant_way',
         '$seed_from',$production_last_season,'$evaluate',$kinds_of_plant,$id_of_zw,1)";
else if ($b=='update')
    $sql="UPDATE zhongzhizuowuxinxi SET L_ID=$id_of_jidi,PE_ID=$id,P_ID=$types_of_plant,P_TIME='$time',SQUARE=$area,ZHUJU=$row_spacing,HANGJU=$column_spacing,
         P_METHOD='$plant_way',S_SOURCE='$seed_from',L_PRODUCTION=$production_last_season,EVALUATE='$evaluate',pinlie=$kinds_of_plant WHERE PE_ID=$id AND L_ID=$id_of_jidi";


if ($con->query($sql))
    echo $id_of_zw;
else
    echo mysqli_error($con);

mysqli_close($con);
?>
