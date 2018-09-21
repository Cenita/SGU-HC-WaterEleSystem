$(
  function()
  {
    $.ajax({
      type:'GET',
      url:'WaterEleCheck.php',
      dataType : "json",
      data:{
        roomId:$(".information").attr("ri"),
        buildingId:$(".information").attr("bi"),
        dokey:$(".information").attr("ke")
      },
      success:function(re){
        for(var i=0;i<6;i++)
        {
          $("#TopUpPart .list").append("<div class=\"item eleItem\"><div>"+re.topUpRecord.money[i]+"</div><div>"+re.topUpRecord.type[i]+"</div><div>"+re.topUpRecord.date[i]+"</div></div>");
        }
        $(".loading").hide();
      },
      error:function(re)
      {

      }
    })

  }
)
