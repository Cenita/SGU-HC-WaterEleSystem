$(
  function()
  {
    $(".getPart").show();
    var sendStyle=new Vue({
    el:".mainPart",
    data:{
      sendPost:false,
      loading:false,
      roomId:"211",
      buildingId:"4369",
      partSeen:false,
      waterRecord:"156.8",
      eleRecord:"20.6",
      averWaterOfSix:"52",
      averWaterOfThree:"50",
      waterEndData:"2018-6-65",
      averEleOfSix:"165",
      averEleOfThree:"15",
      eleEndDate:"2018-3-25",
      roomName:"错误",
      judgeExist:false
    }})
    $('.ui.dropdown').dropdown();
    $("#roomIdButton").change(
      function()
      {
        $(this).removeClass("error");
      }
    )
    $("#buildingId").change(
      function()
      {
        $(this).parents(".error").removeClass("error");
      }
    )
    $("#send").click(
      function()
      {
        if($(this).hasClass("inCheck"))
        {return;}
        var errorReturn=false;
        $(this).addClass("inCheck");
        $(".error").removeClass("error");
        if(sendStyle.roomId=="")
        {
          $("#roomIdButton").addClass("error");
          errorReturn=true;
        }
        if(sendStyle.buildingId=="")
        {
          $(".selection").addClass("error");
          errorReturn=true;
        }
        if(errorReturn)
        {
          $(".inCheck").removeClass("inCheck");
          return ;
        }
        var userkey=$(".madeBy").attr("key");
        sendStyle.partSeen=true;
        sendStyle.sendPost=false;
        sendStyle.loading=true;
        sendStyle.judgeExist=false;
        $.ajax({
          type:'GET',
          url:'WaterEleCheck.php',
          dataType : "json",
          data:{
            roomId:sendStyle.roomId,
            buildingId:sendStyle.buildingId,
            dokey:userkey
          },
          success:function(re)
          {
            $(".inCheck").removeClass("inCheck");
            $(".eleItem").remove();
            if(re.isExist=="no")
            {
              sendStyle.loading=false;
              sendStyle.judgeExist=true;
              return;
            }
            else {
              sendStyle.sendPost=true;
              sendStyle.loading=false;
            }
            sendStyle.roomName=re.roomName+"的水电费";
            //水
            sendStyle.waterRecord=re.waterRecord.now;
            sendStyle.averWaterOfThree=re.waterRecord.userAverageOfDayOfThree;
            sendStyle.averWaterOfSix=re.waterRecord.userAverageOfDayOfSix;
            sendStyle.waterEndData=re.waterRecord.userEndDate;
            //电
            sendStyle.eleRecord=re.eleRecord.now;
            sendStyle.averEleOfSix=re.eleRecord.userAverageOfDayOfSix;
            sendStyle.averEleOfThree=re.eleRecord.userAverageOfDayOfThree;
            sendStyle.eleEndDate=re.eleRecord.userEndDate;
            //列表
            initionGraph(re);
            for(var i=0;i<6;i++)
            {
              //v-else="sendPost"
              $("#TopUpPart .list").append("<div class=\"item eleItem\"><div>"+re.topUpRecord.money[i]+"</div><div>"+re.topUpRecord.type[i]+"</div><div>"+re.topUpRecord.date[i]+"</div></div>");
            }
          },
          error:function(re)
          {
            //alert("查询失败");
            //sendStyle.partSeen=false;
            initionGraph(re);
            $(".inCheck").removeClass("inCheck");
            alert("发生错误");
            sendStyle.sendPost=true;
            sendStyle.loading=false;
            console.log("查询失败");
          }
        })
      }
    )
    function initionGraph(data)
    {
      var waterMoney = echarts.init(document.getElementById('waterGraph'));
      var waterValue = echarts.init(document.getElementById('waterValueGraph'));
      var eleMoney = echarts.init(document.getElementById('eleGraph'));
      var eleValue = echarts.init(document.getElementById('eleValueGraph'));
      var waterDataDate=new Array(6);
      var eleDataMoney=new Array(6);
      var eleDivideValue=new Array(5);
      var waterDataMoney= new Array(6);
      var waterDivideValue=new Array(5);
      var minEleValue=9999;
      var minWaterValue=9999;
      var j=5;
      var eleAverage=0;
      var waterAverage=0;
      for(var i=0;i<6;i++)
      {
        waterDataDate[i]=data.waterRecord.history.date[j];
        waterDataMoney[i]=data.waterRecord.history.left[j];
        eleDataMoney[i]=data.eleRecord.history.left[j];
        minEleValue=minEleValue<Number(eleDataMoney[i])?minEleValue:Number(eleDataMoney[i]);
        minWaterValue=minWaterValue<Number(waterDataMoney[i])?minWaterValue:Number(waterDataMoney[i]);
        if(i!=5)
        {
          eleDivideValue[i]=data.eleRecord.history.left[j]-data.eleRecord.history.left[j-1];
          waterDivideValue[i]=data.waterRecord.history.left[j]-data.waterRecord.history.left[j-1];
          if(waterDivideValue[i]<0)
          {
            if(i==0)
            {
              waterDivideValue[i]=0;
            }
            else {
              waterDivideValue[i]=waterAverage;
            }
          }
          else {
            waterAverage+=waterDivideValue[i];
            waterAverage/=2;
            waterDivideValue[i]=waterDivideValue[i].toFixed(2);
          }
          if(eleDivideValue[i]<0)
          {
            if(i==0)
            {
              eleDivideValue[i]=0;
            }
            else {
              eleDivideValue[i]=eleAverage;
            }
          }
          else {
            eleAverage+=eleDivideValue[i];
            eleAverage/=2;
            eleDivideValue[i]=eleDivideValue[i].toFixed(2);
          }
        }
        j--;
      }
      waterDivideValue[0]=waterDivideValue[0]==0?waterAverage:waterDivideValue[0];
      eleDivideValue[0]=eleDivideValue[0]==0?eleAverage:eleDivideValue[0];
      wValue = {
          xAxis: {
              type: 'category',
              data: [waterDataDate[1], waterDataDate[2], waterDataDate[3],waterDataDate[4],waterDataDate[5]]
          },
          yAxis: {
              name: "日用",
              type: 'value'
          },
          tooltip:{
            //trigger:'axis'
          },
          series: [
          {
            name: "日用",
            data: [waterDivideValue[0], waterDivideValue[1], waterDivideValue[2], waterDivideValue[3], waterDivideValue[4]],
            type: 'line',
            color: "#9e9e9e",
            smooth: true
          },
          {
              name: "日用",
              data: [waterDivideValue[0], waterDivideValue[1], waterDivideValue[2], waterDivideValue[3], waterDivideValue[4]],
              type: 'bar',
              color: "#80beff"
          }]
      };
      wMoney = {
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: [waterDataDate[0], waterDataDate[1], waterDataDate[2], waterDataDate[3],waterDataDate[4],waterDataDate[5]],
            },
            yAxis: {
                type: 'value',
                name: "余额",
                min:Math.floor(minWaterValue-2*waterAverage)
            },
            tooltip:{
              trigger:'axis'
            },
            series: [{
                name: "余额",
                data: [waterDataMoney[0], waterDataMoney[1],waterDataMoney[2], waterDataMoney[3],waterDataMoney[4],waterDataMoney[5]],
                type: 'line',
                areaStyle: {},
                color:"#035faa"
            }]
        };
      eValue = {
          xAxis: {
              type: 'category',
              data: [waterDataDate[1], waterDataDate[2], waterDataDate[3],waterDataDate[4],waterDataDate[5]]
          },
          yAxis: {
              name: "日用",
              type: 'value'
          },
          tooltip:{
            //trigger:'axis'
          },
          series: [
          {
            name: "日用",
            data: [eleDivideValue[0], eleDivideValue[1], eleDivideValue[2], eleDivideValue[3], eleDivideValue[4]],
            type: 'line',
            color: "#9e9e9e",
            smooth: true
          },
          {
              name: "日用",
              data: [eleDivideValue[0], eleDivideValue[1], eleDivideValue[2], eleDivideValue[3], eleDivideValue[4]],
              type: 'bar',
              color: "#FF9900"
          }]
      };
      eMoney = {
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: [waterDataDate[0], waterDataDate[1], waterDataDate[2], waterDataDate[3],waterDataDate[4],waterDataDate[5]],
            },
            yAxis: {
                type: 'value',
                name: "余额",
                min:Math.floor(minEleValue-2*eleAverage)
            },
            tooltip:{
              trigger:'axis'
            },
            series: [{
                name: "余额",
                data: [eleDataMoney[0], eleDataMoney[1],eleDataMoney[2], eleDataMoney[3],eleDataMoney[4],eleDataMoney[5]],
                type: 'line',
                areaStyle: {},
                color:"#e68b00"
            }]
        };
      eleValue.setOption(eMoney);
      eleMoney.setOption(eValue);
      waterValue.setOption(wMoney);
      waterMoney.setOption(wValue);
      $(".graph").css("height","150px");
    }
  }
)
