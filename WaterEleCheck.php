<?php
 include ("js/simpleHtmlDom/simple_html_dom.php");
 error_reporting(E_ALL^E_NOTICE^E_WARNING);
 $cookie_jar = "pic.cookie";
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
 curl_setopt($ch, CURLOPT_URL, $addressHtml);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
 $content = curl_exec($ch);
 curl_close($ch);
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $loginHtml);
 curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $ret = curl_exec($ch);
 curl_close($ch);
 $waterEleHtml=new simple_html_dom();
 $waterEleHtml->load($ret);
 //统计数据
 $intI=0;
 $waterRecord[6]=0.0;
 $waterDate[6]=0;
 $eleRecord[6]=0.0;
 $eleDate[6]=0;
 $roomName="";
 $topUpRecord=array("money"=>array(6),"type"=>array(6),"date"=>array(6));
 $thisYear=strval(date("Y"))."-";
 foreach ($waterEleHtml->find("#usedWaterDiv .tableBody .even") as $usedEle)
 {
    $temp=$usedEle->find("td");
    $roomName=$temp[0]->plaintext;
    $waterRecord[$intI]=$temp[5]->plaintext;
    $waterDate[$intI]=explode($thisYear,explode(" ",strval($temp[6]->plaintext))[2])[1];
    $intI++;
 }
 $intI=0;
 foreach ($waterEleHtml->find("#usedEleDiv .tableBody .even") as $usedEle)
 {
     $temp=$usedEle->find("td");
     $eleRecord[$intI]=$temp[5]->plaintext;
     $eleDate[$intI]=explode($thisYear,explode(" ",strval($temp[6]->plaintext))[2])[1];
     $intI++;
 }
 $intI=0;
 foreach ($waterEleHtml->find("#fillDiv .tableBody .even") as $usedEle)
 {
     $temp=$usedEle->find("td");
     $topUpRecord["money"][$intI]=$temp[1]->plaintext;
     $topUpRecord["type"][$intI]=$temp[3]->plaintext;
     $topUpRecord["date"][$intI]=explode($thisYear,explode(" ",strval($temp[6]->plaintext))[2])[1];
     $intI++;
 }
 $isExist="yes";
 if($waterRecord[0]==NULL)
 {
     $isExist="no";
 }
 //计算日均使用量
 $temp1=0;
 $temp2=0;
 $WaterCount=0;
 $eleCount=0;
 for($i=3;$i>0;$i--)
 {
     $addWater=$waterRecord[$i]-$waterRecord[$i-1];
     $addEle=$eleRecord[$i]-$eleRecord[$i-1];
     if($addWater>0)
     {
         $WaterCount++;
         $temp1+=$addWater;
     }
     if($addEle>0)
     {
         $eleCount++;
         $temp2+=$addEle;
     }
 }
 $waterAverageOfThree=round($temp1/$WaterCount,3);
 $eleAverageOfThree=round($temp2/$eleCount,3);
 $temp1=0;
 $temp2=0;
 $WaterCount=0;
 $eleCount=0;
 for($i=5;$i>0;$i--)
 {
     $addWater=$waterRecord[$i]-$waterRecord[$i-1];
     $addEle=$eleRecord[$i]-$eleRecord[$i-1];
     if($addWater>0)
     {
         $WaterCount++;
         $temp1+=$addWater;
     }
     if($addEle>0)
     {
         $eleCount++;
         $temp2+=$addEle;
     }
 }
 $waterAverageOfSix=round($temp1/$WaterCount,3);
 $eleAverageOfSix=round($temp2/$eleCount,3);
 $waterCanUseDayNum=1;
 $eleCanUseDayNum=1;
 if($waterAverageOfThree>0)
 $waterCanUseDayNum=(int)($waterRecord[0]/$waterAverageOfSix);
 if($eleAverageOfThree>0)
 $eleCanUseDayNum=(int)($eleRecord[0]/$eleAverageOfSix);
 $waterEndDate=date("Y:m:d",strtotime("+".$waterCanUseDayNum." day"));
 $eleEndDate=date("Y:m:d",strtotime("+".$eleCanUseDayNum." day"));
 if($waterAverageOfThree<=0)
 {
     $waterEndDate="null";
 }
 if($eleAverageOfThree<=0)
     $eleEndDate="null";
 $totalSave= array("roomName"=>$roomName,"waterRecord"=>array(
     "now"=>$waterRecord[0],
     "userAverageOfDayOfThree"=>$waterAverageOfThree,
     "userAverageOfDayOfSix"=>$waterAverageOfSix,
     "userEndDate"=>$waterEndDate,
     "history"=>array("left"=>array(6),"date"=>array(6)),
     "leftDay"=>$waterCanUseDayNum
), "eleRecord"=>array(
     "now"=>$eleRecord[0],
     "userAverageOfDayOfThree"=>$eleAverageOfThree,
     "userAverageOfDayOfSix"=>$eleAverageOfSix,
     "userEndDate"=>$eleEndDate,
     "history"=>array("left"=>array(6),"date"=>array(6)),
     "leftDay"=>$eleCanUseDayNum
 )
     ,"topUpRecord"=>array("money"=>array(6),"type"=>array(6),"date"=>array(6))
     ,"isExist"=>$isExist
 );
 for ($i=0;$i<6;$i++)
 {
     $totalSave["waterRecord"]["history"]["left"][$i] = $waterRecord[$i];
     $totalSave["waterRecord"]["history"]["date"][$i] = $waterDate[$i];
     $totalSave["eleRecord"]["history"]["left"][$i] = $eleRecord[$i];
     $totalSave["eleRecord"]["history"]["date"][$i] = $eleDate[$i];
     $totalSave["topUpRecord"]["money"][$i]=$topUpRecord["money"][$i];
     $totalSave["topUpRecord"]["type"][$i]=$topUpRecord["type"][$i];
     $totalSave["topUpRecord"]["date"][$i]=$topUpRecord["date"][$i];
 }
echo json_encode($totalSave);
$waterEleHtml->clear();
?>