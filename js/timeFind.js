$(
  function()
  {
      dateIni();
      var waterStartDate="";
      var waterEndDate="";
      var eleStartDate="";
      var eleEndDate="";
      $("#waterSearch").click(function(){
        if($(this).hasClass("in-search"))
        {return;}
        var userkey=$(".madeBy").attr("dokey");
        $("#waterSearchPart .loading").show();
        $("#waterSearchPart .weList").hide();
        $("#waterTips").hide();
        $(this).addClass("in-search");
        $("#waterSearchPart .eleItem").remove();
        $.ajax({type:'POST', dataType:"json", url:"php/sendRecord.php", data:{type:"3"}})
        $.ajax(
          {
            type:"GET",
            url:'php/water/waterDateData.php',
            dataType : "json",
            data:{
              beginDate:waterStartDate,
              endDate:waterEndDate,
              dokey:userkey
            },
            success:function(re)
            {
              $("#waterSearch").removeClass("in-search");
              $("#waterSearchPart .loading").hide();
              if(re.waterNum=="-1"||re.waterNum=="0")
              {
                alert("这段时间内没有水费记录");
                return ;
              }
              $("#waterSearchPart .weList").show();
              for(var i=0;i<re.waterNum;i++)
              {
                $("#waterSearchPart .list").append("<div class=\"item eleItem\"><div>"+re.haveEleMoney[i]+"</div><div>"+re.waterDate[i]+"</div></div>");
              }
              if(re.waterNum==15)
              {
                $("#waterTips").show();
              }
            },
            error:function(re)
            {
              $("#waterSearch").removeClass("in-search");
              $("#waterSearchPart .loading").hide();
              alert("查询失败");
            }
          }
        )
      }
)

$("#eleSearch").click(function(){
  if($(this).hasClass("in-search"))
  {return;}
  var userkey=$(".madeBy").attr("dokey");
  $("#eleSearchPart .loading").show();
  $("#eleSearchPart .weList").hide();
  $("#eleTips").hide();
  $(this).addClass("in-search");
  $("#eleSearchPart .eleItem").remove();
  $.ajax({type:'POST', dataType:"json", url:"php/sendRecord.php", data:{type:"2"}})
  $.ajax(
    {
      type:"GET",
      url:'php/ele/eleDateData.php',
      dataType : "json",
      data:{
        beginDate:eleStartDate,
        endDate:eleEndDate,
        dokey:userkey
      },
      success:function(re)
      {
        $("#eleSearch").removeClass("in-search");
        $("#eleSearchPart .loading").hide();
        if(re.eleNum=="-1"||re.eleNum=="0")
        {
          alert("这段时间内没有水费记录");
          return ;
        }
        $("#eleSearchPart .weList").show();
        for(var i=0;i<re.eleNum;i++)
        {
          $("#eleSearchPart .list").append("<div class=\"item eleItem\"><div>"+re.haveEleMoney[i]+"</div><div>"+re.eleDate[i]+"</div></div>");
        }
        if(re.eleNum==15)
        {
          $("#eleTips").show();
        }
      },
      error:function(re)
      {
        $("#eleSearch").removeClass("in-search");
        $("#eleSearchPart .loading").hide();
        alert("查询失败");
      }
    }
  )
}
)



      function dateIni()
      {
        $("#waterStartDate").kinerDatePicker({
        clickMaskHide: true,
        okHandler: function(vals, ctx) {
          waterStartDate=vals[0]+"-"+vals[1]+"-"+vals[2];
        }
          });
            $("#waterEndDate").kinerDatePicker({
            clickMaskHide: true,
            okHandler: function(vals, ctx) {
              waterEndDate=vals[0]+"-"+vals[1]+"-"+vals[2];
            }
          });
          $("#eleStartDate").kinerDatePicker({
          clickMaskHide: true,
          okHandler: function(vals, ctx) {
            eleStartDate=vals[0]+"-"+vals[1]+"-"+vals[2];
          }
        });
          $("#eleEndDate").kinerDatePicker({
          clickMaskHide: true,
          okHandler: function(vals, ctx) {
            eleEndDate=vals[0]+"-"+vals[1]+"-"+vals[2];
          }
        });
      }
  }
)
