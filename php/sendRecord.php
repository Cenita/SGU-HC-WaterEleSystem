<?php
    include "interface/sendPostApi.php";
    if(isset($_POST["type"]))
    {
        $data=array("ip"=>$_SERVER['REMOTE_ADDR'],"type"=>$_POST["type"]);
        echo send_post("http://schtt.cn/interface/recordOne.php",$data);
    }
?>