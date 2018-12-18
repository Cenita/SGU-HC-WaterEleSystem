<?php
 include ("../../js/simpleHtmlDom/simple_html_dom.php");
 error_reporting(E_ALL^E_NOTICE^E_WARNING);
 $cookie_jar = "pic.cookie";
 header("content-Type: text/html; charset=Utf-8");
 session_start();
// $dokey=strval($_SESSION['key']);
// $getKey=strval($_GET["dokey"]);
// if($dokey!=$getKey||$dokey=="")
// {
//     echo "error";
//     return;
// }
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
 //统计数据
 $intI=0;
 $isExist="yes";
 if($waterEleHtml->find("#usedWaterDiv .tableBody .even")[0]->plaintext!="")
 {
    $roomName=$waterEleHtml->find("#usedWaterDiv .tableBody .even")[0]->find("td")[0]->plaintext;
    $waterNow=$waterEleHtml->find("#usedWaterDiv .tableBody .even")[0]->find("td")[5]->plaintext;
    $eleNow=$waterEleHtml->find("#usedEleDiv .tableBody .even")[0]->find("td")[5]->plaintext;
 }
 else
 {
    $isExist="no";
 }
 //计算日均使用量
 $totalSave= array(
   "roomName"=>$roomName
   ,"waterRecord"=>array("now"=>$waterNow)
   ,"eleRecord"=>array("now"=>$eleNow)
   ,"isExist"=>$isExist
 );
echo json_encode($totalSave);
$waterEleHtml->clear();
?>