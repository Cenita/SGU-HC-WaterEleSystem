<?php
    include("db_config.php");
    $ip=$_POST["ip"];
    $type=$_POST["type"];
    $nowTime=time();
    $id=md5($nowTime+666);
    $con=mysqli_connect(constant("db_host"),constant("db_name"),constant("db_password"),"wrrecord");
    if(isset($_POST["ip"])&&isset($_POST["type"]))
    {
        mysqli_query($con,"set names gb2312");
        $ip=mysqli_escape_string($con,$ip);
        $type=mysqli_escape_string($con,$type);
        if(!$con)
        {
            echo (mysqli_error());
        }
        $insertSql="INSERT INTO postlist (id,time,ip,type) VALUES('$id','$nowTime','$ip','$type')";
        mysqli_query($con,$insertSql);
        echo json_encode(array("status"=>"200","message"=>"success to save"));
    }
    else
    {
        echo json_encode(array("status"=>"200","message"=>"error by no type"));
    }
?>