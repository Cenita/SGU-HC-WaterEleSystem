<?php
include ("../../js/simpleHtmlDom/simple_html_dom.php");
$cookie_jar = "pic.cookie";
session_start();
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$roomMate=$_SESSION["roomId"];
$buildingId=$_SESSION["buildingId"];
$addressHtml="http://210.38.192.120:8080/sdms-select/webSelect/roomFillLogView1.do?roomName=".$roomMate."&buildingId=".$buildingId;
$loginHtml="http://210.38.192.120:8080/sdms-select/webSelect/findUsedQuantityWaterView.do";
$ch = curl_init();
header("Access-Control-Allow-Origin: *");
date_default_timezone_set("PRC");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginHtml);
curl_setopt($ch, CURLOPT_COOKIE, $_SESSION["idBySession"]);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_exec($ch);
curl_close($ch);
$waterEleHtml=new simple_html_dom();
$waterEleHtml->load($ret);
//获取宿舍号
$roomNumId=$waterEleHtml->find(".opear input")[0]->value;
$beginDate=$_GET["beginDate"];
$endDate=$_GET["endDate"];
$postHtml="http://210.38.192.120:8080/sdms-select/webSelect/findUsedQuantityWaterView.do?roomId=".$roomNumId."&beginTime=".$beginDate."&endTime=".$endDate;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $postHtml);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_exec($ch);
curl_close($ch);
$waterEleHtml=new simple_html_dom();
$waterEleHtml->load($ret);
$eleNum=-1;
foreach ($waterEleHtml->find("#ec_table .tableBody tr") as $usedEle)
{
    $eleNum++;
}
$eleMoney=array($eleNum);
$eleDate=array($eleNum);
$intI=0;
foreach ($waterEleHtml->find("#ec_table .tableBody tr") as $usedEle)
{
    $temp=$usedEle->find("td");
    $eleMoney[$intI]=$temp[5]->plaintext;
    $eleDate[$intI]=explode(" ",strval($temp[6]->plaintext))[0];
    $intI++;
}
$totalOut=array(
    "waterNum"=>$eleNum,
    "haveEleMoney"=>array($eleNum),
    "waterDate"=>array($eleNum)
);
for($i=0;$i<$eleNum;$i++)
{
    $totalOut["haveEleMoney"][$i]=$eleMoney[$i];
    $totalOut["waterDate"][$i]=$eleDate[$i];
}
echo json_encode($totalOut);
?>