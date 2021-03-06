<?php
    include ("../../js/simpleHtmlDom/simple_html_dom.php");
    error_reporting(E_ALL^E_NOTICE^E_WARNING);
    header("content-Type: text/html; charset=Utf-8");
    session_start();
    $dokey=strval($_SESSION['key']);
    $getKey=strval($_GET["dokey"]);
    if($dokey!=$getKey||$dokey=="")
    {
        echo "error";
        return;
    }
    //爬虫
    $roomMate=$_GET["roomId"];
    $buildingId=$_GET["buildingId"];
    $_SESSION["roomId"]=$roomMate;
    $_SESSION["buildingId"]=$buildingId;
    $addressHtml="http://210.38.192.120:8080/sdms-select/webSelect/roomFillLogView1.do?roomName=".$roomMate."&buildingId=".$buildingId;
    $loginHtml="http://210.38.192.120:8080/sdms-select/webSelect/welcome2.jsp";
    $ch = curl_init();
    header("Access-Control-Allow-Origin: *");
    date_default_timezone_set("PRC");
    unset($_SESSION["allData"]);
    curl_setopt($ch, CURLOPT_URL, $addressHtml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
    curl_setopt($ch,CURLOPT_HEADER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    list($header, $body) = explode("\r\n\r\n", $ret);
    preg_match("/set\-cookie:([^\r\n]*)/i", $header, $matches);
    $_SESSION["idBySession"]=$matches[1];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $loginHtml);
    curl_setopt($ch, CURLOPT_COOKIE, $_SESSION["idBySession"]);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    $waterEleHtml=new simple_html_dom();
    $waterEleHtml->load($ret);
    $isExist="yes";
    $roomName="";
    $water="no";
    foreach($waterEleHtml->find("#usedWaterDiv .tableBody .even") as $temp)
    {
        $temp2=$temp->find("td");
        $water=$temp2[5]->plaintext;
        $roomName=$temp2[0]->plaintext;
    }
    $_SESSION["roomName"]=$roomName;
    if($water=="no")
    {
        $isExist="no";
    }
    setcookie("isExist",$isExist,time()+604800,"/");
    setcookie("roomId",$roomMate,time()+604800,"/");
    setcookie("buildingId",$buildingId,time()+604800,"/");
    $infor=Array(
      "isExist"=>$isExist,
      "roomName"=>$roomName
    );
    $_SESSION["isExist"]=$isExist;
    echo json_encode($infor);
?>