$(
  function()
  {
    var count=0;
    var down=false;
    $("#logoImg").click(
      function()
      {
        count++;
        if(count>=4)
        {
          down=true;
          $(this).hide();
          $("#logo1").show();
          $("#logo2").show();
          $("#logo2").animate({top:"50px",opacity:"0"},"slow");
        }
        else {
          $(this).rotate({animateTo:45*count});
          $("#logo1").rotate(45*count);
          $("#logo2").rotate(45*count);
        }
      }
    )
    $(".logoPart img").click(
      function()
      {
        if(down)
        {
          $("#logo1").rotate({animateTo:45*count});
          $("#logo2").rotate({animateTo:45*count});
          count++;
        }
        else if(count>5){

          window.location.href="http://www.hclab.cn/hclab/index.php";
        }
        if(count==10)
        {
          down=false;
          $("#logo2").rotate(180);
          $("#logo1").animate({left:"55px",width:"40px",top:"-4px",left:"47px"}).rotate({animateTo:61});
          $("#logo2").animate({opacity:"1",top:"-5px",left:"-25px",width:"32px",height:"41px"});
          $("#mask").show().delay(600).animate({left:"310px"},1000);
          $("#logoEnd").show().delay(600).animate({opacity:"1"});
          $(".logoPart").css("cursor","pointer");
        }
      }
    )
  }
)
