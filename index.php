<!DOCTYPE html>
<?php
      error_reporting(E_ALL^E_NOTICE^E_WARNING);
     session_start();
     $sendKey=md5(time());
     $_SESSION['key']=$sendKey;
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/vue/2.5.17-beta.0/vue.min.js"></script>
  <script src="https://cdn.bootcss.com/semantic-ui/2.3.1/semantic.min.js"></script>
  <script src="https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts.js"></script>
  <link href="https://cdn.bootcss.com/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">
  <script type="text/javascript" src="js/index.js"></script>
  <title>韶关学院水电费查询</title>
</head>
<body>
  <div class="mainPart">
    <div class="checkPart">
      <div class="bigTitle">
        <span>韶关学院水电查询</span>
      </div>
      <div class="roomPart">
        <span class="title">房间号：</span>
        <div class="ui input">
          <input type="number" data="<?php $t=$_SESSION["roomId"];echo $t;?>" id="roomIdButton" v-model="roomId" placeholder="(例如104)">
        </div>
      </div>
      <div class="buildingPart">
        <span class="title">楼层编号：</span>
        <select class="ui dropdown" data="<?php $t=$_SESSION["buildingId"];echo $t;?>"  v-model="buildingId" size="6"  id="buildingId">
          <option value="1177">碧桃21栋</option>
          <option value="1250">碧桃24栋</option>
          <option value="1623">碧桃25栋</option>
          <option value="1649">碧桃27栋</option>
          <option value="1332">碧桃28栋</option>
          <option value="1366">碧桃29栋</option>
          <option value="1426">丹桂22栋</option>
          <option value="1486">丹桂23栋</option>
          <option value="1688">丹竹A栋</option>
          <option value="1811">丹竹B栋</option>
          <option value="1924">丹竹C栋</option>
          <option value="2047">碧桂B栋</option>
          <option value="2114">碧桂C栋</option>
          <option value="2202">碧桂A栋</option>
          <option value="2317">红枫A栋</option>
          <option value="2710">海棠A栋</option>
          <option value="2807">海棠B栋</option>
          <option value="2904">紫荆A栋</option>
          <option value="3151">紫荆B栋</option>
          <option value="3271">紫荆C栋</option>
          <option value="3405">紫薇A栋</option>
          <option value="3517">紫薇B栋</option>
          <option value="3629">紫薇C栋</option>
          <option value="3763">丁香A栋</option>
          <option value="3884">丁香B栋</option>
          <option value="4005">丁香C栋</option>
          <option value="4126">丁香D栋</option>
          <option value="4247">丁香E栋</option>
          <option value="4369">丁香G栋</option>
          <option value="4492">丁香F栋</option>
          <option value="4613">海棠C栋</option>
          <option value="4710">秋枫A栋</option>
          <option value="4807">秋枫B栋</option>
          <option value="4904">秋枫C栋</option>
          <option value="5001">秋枫D栋</option>
          <option value="5133">蔷薇A栋</option>
          <option value="5246">蔷薇B栋</option>
          <option value="5359">蔷薇C栋</option>
          <option value="5456">芙蓉A栋</option>
          <option value="5569">芙蓉B栋</option>
          <option value="5682">芙蓉C栋</option>
          <option value="5795">芙蓉D栋</option>
          <option value="5908">银杏A栋</option>
          <option value="6011">银杏B栋</option>
          <option value="6090">丹枫A栋</option>
          <option value="6169">丹枫B栋</option>
          <option value="6290">红棉东栋</option>
          <option value="6320">红枫B栋</option>
          <option value="6326">红棉西栋</option>
          <option value="6378">碧桃20栋</option>
          <option value="6481">丹桂26栋</option>
          <option value="6546">黄田坝6栋</option>
          <option value="6610">黄田坝10栋</option>
          <option value="6689">黄田坝12栋</option>
          <option value="6767">黄田坝9栋</option>
          <option value="6849">紫竹A栋</option>
          <option value="6988">紫竹B栋</option>
          <option value="7169">樱花苑栋</option>
          <option value="7444">梧桐苑栋</option>
        </select>
      </div>
      <button id="send" class="ui primary button">查询</button>
    </div>
    <div style="display:none"  v-show="partSeen" class="getPart">
      <div class="ui loading segment" v-show="loading"   style="height:300px;z-index:-20;">
      </div>
      <div class="ui raised segment" v-show="sendPost" id="inPart" >
        <h4 class="ui horizontal divider header">{{roomName}}</h4>
        <div id="getBasicInformation">
          <div class="getWaterPart topInformation" style="font-size:15px">
            <span class="title">水费：</span>
            <span class="content">{{ waterRecord }}元</span>
          </div>
          <div class="getElePart topInformation" style="font-size:15px">
            <span class="title">电费：</span>
            <span class="content">{{ eleRecord }}元</span>
          </div>
        </div>
        <h4 class="ui horizontal divider header" style="display:none">充值记录表</h4>
        <div id="TopUpPart" style="display:none">
          <div class="ui middle aligned list">
            <div class="item">
              <div>充值金额</div>
              <div>充值类型</div>
              <div>日期</div>
            </div>
          </div>
        </div>
      </div>
      <div class="ui raised segment" v-show="sendPost">
        <h4 class="ui horizontal divider header" style="color:#FF9900">
          <i class="fa fa-flash"></i>
        </h4>
        <div id="sixDayElePart">
          <div class="forecastEndDay">
            <span class="title">预测停电日期：</span>
            <span class="content">{{eleEndDate}}</span>
          </div>
          <div class="graphPart" style="position:relative;top:-20px;left:-10px">
            <div class="averageOfSixDay topInformation">
              <span class="title">六日平均：</span>
              <span class="content">{{averEleOfSix}}元</span>
            </div>
            <div class="averageOfThreeDay topInformation">
              <span class="title">三日平均：</span>
              <span class="content">{{averEleOfThree}}元</span>
            </div>
            <div id="eleGraph" class="graph"></div>
            <div id="eleValueGraph" class="graph"></div>
            <div class="aiPart">
              <span>小创AI：{{eleHint}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="ui raised segment" v-show="sendPost">
        <h4 class="ui horizontal divider header" style="color:#167fd4">
          <i class="fa fa-tint"></i>
        </h4>
        <div id="sixDayWaterPart">
          <div class="forecastEndDay">
            <span class="title">预测停水日期：</span>
            <span class="content">{{waterEndData}}</span>
          </div>
          <div class="graphPart" style="position:relative;top:-20px;left:-10px">
            <div class="averageOfSixDay topInformation">
              <span class="title">六日平均：</span>
              <span class="content">{{averWaterOfSix}}元</span>
            </div>
            <div class="averageOfThreeDay topInformation">
              <span class="title">三日平均：</span>
              <span class="content">{{averWaterOfThree}}元</span>
            </div>
            <div id="waterGraph" class="graph"></div>
            <div id="waterValueGraph" class="graph"></div>
            <div class="aiPart">
              <span>小创AI：{{waterHint}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="display:none" class="ui raised segment inexistence" v-show="judgeExist" style="margin-top:30px;">
      <div style="color:red;text-align:center">宿舍不存在!</div>
    </div>
  </div>
  <div id="metrePart">
    <div class="ICT">
        <div class="tips">因与学校端口更新时间不一,部分宿舍会有少量误差。</div>
      <div class="p1">Copyright © 2018-2019 schtt.cn All Rights Reserved.</div>
      <div class="p2">备案号：粤ICP备18017795号-1</div>
    </div>
    <div class="madeBy" key="<?php echo $sendKey?>">
      MADE BY CHENHUITAO
    </div>
  </div>

</body>
</html>
