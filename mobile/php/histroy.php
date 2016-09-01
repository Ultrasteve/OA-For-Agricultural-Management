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
if($str=='jidi') {
    $sql = "select * from history_of_jd WHERE username=$id";
    if(!$result=$con->query($sql))
        echo "连接失败，错误原因:$con->error";
    else{
        while( $row=$result->fetch_array())
        {
            $sql2="select NAME from zhongzhihuxinxi WHERE ID=".$row['id'];
            if(!$result2=$con->query($sql))
                echo "连接失败，错误原因:$con->error";
            else{
                while ($row2=$result2->fetch_array())
                {
                    $array[$i++]=array("id"=>$row['id'],"name"=>$row2['NAME']);

                }
            }

        }
    }
    $result2->free();
}
else if ($str=='nh'){
    $sql="select * from history_of_nh where username=$id";
    if(!$result=$con->query($sql))
        echo "连接失败，错误原因:$con->error";
    else
        while( $row=$result->fetch_array())
            $array[$i++]=array("id"=>$row['id'],"name"=>$row['name']);
    $result2->free();
}
else{
    $sql = "select * from history_of_zw WHERE username=$id";
    if(!$result=$con->query($sql))
        echo "连接失败，错误原因:$con->error";
    else{
        while( $row=$result->fetch_array())
        {
            $sql2="select NAME from zhongzhihuxinxi WHERE ID=".$row['id'];
            if(!$result2=$con->query($sql))
                echo "连接失败，错误原因:$con->error";
            else{
                while ($row2=$result2->fetch_array())
                {
                    $array[$i++]=array("id"=>$row['id'],"name"=>$row2['NAME']);

                }
            }
        }
    }

}


echo json_encode($array);
$result->free();
$con->close();
?>
