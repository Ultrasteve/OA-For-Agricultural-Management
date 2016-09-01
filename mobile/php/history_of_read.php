<?php
/**
 * Created by IntelliJ IDEA.
 * User: lujiajian
 * Date: 2016/8/24
 * Time: 15:05
 */
header("Content-type: text/html; charset=utf-8");
$str=$_POST['str'];
$id=$_POST['id'];
$i=0;
$con=new mysqli("localhost","ccc307","cccccc","ccc307");
if(!$con)
    die("连接失败,错误原因:".$con->error);
if($str=='jd') {
    $sql = "select id from history_of_jd WHERE username=$id";
    if(!$result=$con->query($sql))
        die( "连接history_of_zw失败，错误原因:$con->error");
    else{
        while( $row=$result->fetch_assoc())
        {
            $id2=$row['id'];
            $sql2="select M_ID from zhongzhijidixinxi WHERE ID=$id2";
            if(!$result2=$con->query($sql2))
                die("连接zhongzhizuowuxinxi失败，错误原因:$con->error");
            else{
                while ($row2=$result2->fetch_assoc()) {
                    $sql3 = "select NAME from zhongzhihuxinxi WHERE ID=" . $row2['M_ID'];
                    if (!$result3 = $con->query($sql3))
                        echo "连接zhongzhihuxinxi失败，错误原因:$con->error";
                    else {
                        if ($row3 = $result3->fetch_assoc())
                            $array[$i++] = array("id" => $row['id'], "name" => $row3['NAME']);
                        else
                            echo "row3 error";
                    }
                    $result3->free();
                }
            }

        }

    }
}
else if ($str=='nh'){
    $sql="select * from history_of_nh where username=$id";
    if(!$result=$con->query($sql))
        echo "连接失败，错误原因:$con->error";
    else
        while( $row=$result->fetch_array())
            $array[$i++]=array("id"=>$row['id'],"name"=>$row['name']);
}
else{
    $sql = "select id from history_of_zw WHERE username=$id";

    if(!$result=$con->query($sql))
        die( "连接history_of_zw失败，错误原因:$con->error");
    else{

        while( $row=$result->fetch_assoc())
        {
            $id2=$row['id'];
            $sql2="select PE_ID from zhongzhizuowuxinxi WHERE zuowubianhao=$id2 AND FINISH=1";
            if(!$result2=$con->query($sql2))
                die("连接zhongzhizuowuxinxi失败，错误原因:$con->error");
            else{
                while ($row2=$result2->fetch_assoc()) {
                    $sql3 = "select NAME from zhongzhihuxinxi WHERE ID=" . $row2['PE_ID'];
                    if (!$result3 = $con->query($sql3))
                        echo "连接zhongzhihuxinxi失败，错误原因:$con->error";
                    else {
                        if ($row3 = $result3->fetch_assoc())
                            $array[$i++] = array("id" => $row['id'], "name" => $row3['NAME']);
                        else
                            echo "row3 error";
                    }
                    $result3->free();
                }
            }

        }

    }

}


echo json_encode($array);
$result->free();
$con->close();
?>
