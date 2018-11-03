$(
  function()
  {
    $(".getPart").show();
    var sendStyle=new Vue({
    el:".mainPart",
    data:{
      sendPost:false,
      loading:false,
      roomId:$(".madeBy").attr("roomId"),
      buildingId:$(".madeBy").attr("buildingId"),
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
      judgeExist:false,
      waterHint:"你好呀",
      eleHint:"你好哦"
    }})
    $('.ui.dropdown').dropdown("set value 6849");
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
        var userkey=$(".madeBy").attr("dokey");
        sendStyle.partSeen=true;
        sendStyle.sendPost=false;
        sendStyle.loading=true;
        sendStyle.judgeExist=false;
        $.ajax({type:'POST', dataType:"json", url:"php/sendRecord.php", data:{type:"1"}})
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
            $(".outPage").addClass("canSele");
            $(".eleItem").remove();
            if(re.isExist=="no")
            {
              $(".canSele").removeClass("canSele");
              sendStyle.loading=false;
              sendStyle.judgeExist=true;
              $(".bigTitle span").text("韶关学院水电查询");
              return;
            }
            else {
              sendStyle.sendPost=true;
              sendStyle.loading=false;
            }
            $(".bigTitle span").text(re.roomName+"的水电费");
            sendStyle.roomName=re.roomName+"的水电费";
            //水
            sendStyle.waterRecord=re.waterRecord.now;
            sendStyle.averWaterOfThree=re.waterRecord.userAverageOfDayOfThree;
            sendStyle.averWaterOfSix=re.waterRecord.userAverageOfDayOfSix;
            var date=re.waterRecord.userEndDate.split(":");
            sendStyle.waterEndData=date[0]+"年"+date[1]+"月"+date[2]+"日";
            //电
            sendStyle.eleRecord=re.eleRecord.now;
            sendStyle.averEleOfSix=re.eleRecord.userAverageOfDayOfSix;
            sendStyle.averEleOfThree=re.eleRecord.userAverageOfDayOfThree;
            var date=re.eleRecord.userEndDate.split(":");
            sendStyle.eleEndDate=date[0]+"年"+date[1]+"月"+date[2]+"日";
            //列表
            initionGraph(re);
            //小创ai
            var aiText="";
            var eleInMoney=(30-re.eleRecord.leftDay)*re.eleRecord.userAverageOfDayOfSix;
            eleInMoney=eleInMoney.toFixed(0);
            if(re.eleRecord.leftDay>5&&re.eleRecord.leftDay<=10)
            {
              if(eleInMoney!=0)
              aiText="电费快不够了哦！小创建议你充值"+eleInMoney+"元";
              else {aiText="哦嚯！这间宿舍好像存在一些问题";}
            }
            else if(re.eleRecord.leftDay<=5)
            {
              if(eleInMoney!=0)
              aiText="快停电啦！小创建议你充"+eleInMoney+"元";
              else {aiText="哦嚯！这间宿舍好像存在一些问题";}
            }
            else if(re.eleRecord.leftDay<=30&&re.eleRecord.leftDay>=20)
            {aiText="还不用担心电费问题哦！";}
            else if(re.eleRecord.leftDay<=20&&re.eleRecord.leftDay>=10)
            {aiText="剩余电费还能用一段时间呢！"}
            else if(re.eleRecord.leftDay>=30)
            {aiText="电力十足！！能用很久呢！！！"}
            sendStyle.eleHint=aiText;
            var aiText="";
            var waterInMoney=(30-re.waterRecord.leftDay)*re.waterRecord.userAverageOfDayOfSix;
            waterInMoney=waterInMoney.toFixed(0);
            if(re.waterRecord.leftDay>5&&re.waterRecord.leftDay<=10)
            {
              if(waterInMoney!=0)
              {aiText="水费快不够了哦！小创建议你充值"+waterInMoney+"元";}
              else
              {aiText="哦嚯！这间宿舍好像存在一些问题";}
            }
            else if(re.waterRecord.leftDay<=5)
            {
              if(waterInMoney!=0)
              {aiText="快停水了哦！小创建议你充值"+waterInMoney+"元";}
              else
              {aiText="哦嚯！这间宿舍好像存在一些问题";}
            }
            else if(re.waterRecord.leftDay<=20&&re.waterRecord.leftDay>10)
            {
              aiText="水费还能用一段时间哦！";
            }
            else if(re.waterRecord.leftDay<=30&&re.waterRecord.leftDay>=20)
            {
              aiText="可以放心一段时间了";
            }
            else if(re.waterRecord.leftDay>=30)
            {
              aiText="水还能用很久！毫不慌张！";
            }
            sendStyle.waterHint=aiText;

          },
          error:function(re)
          {
            //alert("查询失败");
            //sendStyle.partSeen=false;
            $(".canSele").removeClass("canSele");
            initionGraph(re);
            $(".inCheck").removeClass("inCheck");
            alert("发生错误");
            $(".bigTitle span").text("韶关学院水电查询");
            sendStyle.sendPost=true;
            sendStyle.loading=false;
            console.log("查询失败");
          }
        })
      }
    )
    $(".canSele").click(
      function()
      {
        console.log("asf");
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
              waterDivideValue[i]=waterAverage.toFixed(2);
            }
          }
          else {
            waterAverage+=waterDivideValue[i];
            if(i!=0)
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
              eleDivideValue[i]=eleAverage.toFixed(2);
            }
          }
          else {
            eleAverage+=eleDivideValue[i];
            if(i!=0)
            eleAverage/=2;
            eleDivideValue[i]=eleDivideValue[i].toFixed(2);
          }
        }
        j--;
      }
      waterDivideValue[0]=waterDivideValue[0]==0?waterAverage.toFixed(2):waterDivideValue[0];
      eleDivideValue[0]=eleDivideValue[0]==0?eleAverage.toFixed(2):eleDivideValue[0];
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
