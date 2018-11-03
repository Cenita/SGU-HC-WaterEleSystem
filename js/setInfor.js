$(
  function()
  {
    ini();
	function setCookie(name, value, liveMinutes) {  
			if (liveMinutes == undefined || liveMinutes == null) {
				liveMinutes = 60 * 2;
			}
			if (typeof (liveMinutes) != 'number') {
				liveMinutes = 60 * 2;//默认120分钟
			}
			var minutes = liveMinutes * 60 * 1000;
			var exp = new Date();
			exp.setTime(exp.getTime() + minutes + 8 * 3600 * 1000);
			//path=/表示全站有效，而不是当前页
			document.cookie = name + "=" + value + ";path=/;expires=" + exp.toUTCString();
		}
    function ini()
    {
      if($("#bend").text()=="取消绑定")
      {
        var roomId=$("#roomIdButton").val();
        var buildingId=$(".buildingPart .dropdown .text").text();
        $(".roomPart .input").hide();
        $("#roomBandTitle").show();
        $("#builBandTitle").show();
        $("#roomBandTitle").text(roomId);
        $(".buildingPart .dropdown").hide();
        $("#builBandTitle").text(buildingId);
      }
      else {
        $(".roomPart .input").show();
        $("#roomBandTitle").hide();
        $(".buildingPart .dropdown").show();
        $("#builBandTitle").hide();
      }
    }
    $("#setRoom").click(
      function()
      {
        var roomId=$("#roomIdButton").val();
        var buildingId=$("#buildingId").dropdown("get value");
        var buildingName=$(".buildingPart .dropdown .text").text();
        var key=$(".madeBy").attr("dokey");
        if($("#bend").text()=="取消绑定")
        {
          $("#bend").show();
          $("#log").hide();
          $("#bend").text("绑定");
          $("#setRoom").removeClass("hasBend");
          $(".bigTitle span").text("韶关学院水电查询");
          $(".inCheck").removeClass("inCheck");
          $(".canSele").removeClass("canSele");
          $(".roomPart .input").show();
          $("#roomBandTitle").hide();
          $(".buildingPart .dropdown").show();
          $("#builBandTitle").hide();
          $.ajax(
            {
              type:'GET',
              url:'php/setInfor/setInfor.php',
              dataType : "json",
              data:{
                roomId:"",
                buildingId:"",
                dokey:key,
              }
            }
          )
          return;
        }
        if($(this).hasClass("inCheck"))
        {return;}
        var isExist=$(".madeBy").attr("autoCheck");
        var errorReturn=false;
        $(this).addClass("inCheck");
        $(".error").removeClass("error");
        if(roomId=="")
        {
          $("#roomIdButton").addClass("error");
          errorReturn=true;
        }
        if(buildingId==null)
        {
          if($(".madeBy").attr("buildingId")!="")
          {
            buildingId=$(".madeBy").attr("buildingId");
          }
          else {
            $(".selection").addClass("error");
            errorReturn=true;
          }
        }
        if(errorReturn)
        {
          $(".inCheck").removeClass("inCheck");
          return ;
        }
        $("#bend").hide();
        $("#log").show();
        $("#roomDisExist").hide();
        $.ajax({type:'POST', dataType:"json", url:"php/sendRecord.php", data:{type:"0"}})
        $.ajax(
          {
            type:'GET',
            url:'php/setInfor/setInfor.php',
            dataType : "json",
            data:{
              roomId:roomId,
              buildingId:buildingId,
              dokey:key,
            },
            success:function(re)
            {
              if(re.isExist=="yes")
              {
                $(".roomPart .input").hide();
                $("#roomBandTitle").show();
                $("#builBandTitle").show();
                $("#roomBandTitle").text(roomId);
                $(".buildingPart .dropdown").hide();
                $("#builBandTitle").text(buildingName);
                $("#bend").show();
                $("#bend").text("取消绑定");
                $("#setRoom").addClass("hasBend");
                $("#log").hide();
                $(".inCheck").removeClass("inCheck");
                $(".outPage").addClass("canSele");
                $(".bigTitle span").text(re.roomName+"的水电费");
              }
              else {
                $("#bend").show();
                $("#log").hide();
                $(".bigTitle span").text("韶关学院水电查询");
                $(".inCheck").removeClass("inCheck");
                $("#roomDisExist").show();
                $(".canSele").removeClass("canSele");
              }
            },
            error:function(re)
            {
              $("#bend").show();
              $("#log").hide();
              $(".bigTitle span").text("韶关学院水电查询");
              $(".inCheck").removeClass("inCheck");
              $("#roomDisExist").show();
              $(".canSele").removeClass("canSele");
            }
          }
        )
      }
    )
  }
)
