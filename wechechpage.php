<script>
    $(
        function () {
            if($(".madeBy").attr("autoCheck")=="yes")
            {
                $("#send").click();
            }
        }
    )
</script>
<button id="send" style="display: none;" class="ui primary button">查询</button>
</div>
<div style="display:none"  v-show="partSeen" class="getPart">
<div class="ui loading segment" v-show="loading"   style="height:300px;z-index:-20;">
</div>
<div class="ui raised segment" v-show="sendPost" id="inPart" >
  <h4 class="ui horizontal divider header" style="margin-top: -14px;">{{roomName}}</h4>
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
        <span class="title">预计月均：</span>
        <span class="content">{{EleMonthly}}元</span>
      </div>
      <div class="averageOfThreeDay topInformation">
        <span class="title">六日平均：</span>
        <span class="content">{{averEleOfSix}}元</span>
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
        <span class="title">预计月均：</span>
        <span class="content">{{WaterMonthly}}元</span>
      </div>
      <div class="averageOfThreeDay topInformation">
        <span class="title">六日平均：</span>
        <span class="content">{{averWaterOfSix}}元</span>
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

