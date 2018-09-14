<?php
    $url="http://47.106.255.252/WaterEleCheck.php";
    $roomId=$_GET["roomId"];
    $buildingId=$_GET["buildingId"];
    echo file_get_contents($url."?roomId=".$roomId."&buildingId=".$buildingId);
?>