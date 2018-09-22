<!DOCTYPE html>
<?php
      error_reporting(E_ALL^E_NOTICE^E_WARNING);
     session_start();
     $sendKey=md5(md5(time()+"asfasf"));
     $page=$_GET["page"];
     if($page!="set"&&$_SESSION["isExist"]!="yes") header("location:?page=set");
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
  <script type="text/javascript" src="js/wecheck.js"></script>
  <script type="text/javascript" src="js/jquery.rotate.min.js"></script>
  <script type="text/javascript" src="js/EasterEgg.js"></script>
  <script type="text/javascript">
      (function() {
       var s = document.createElement('script');
       s.type = 'text/javascript';
       s.async = true;
       s.src = 'https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts.js';
       var x = document.getElementsByTagName('script')[0];
       x.parentNode.insertBefore(s, x);
       var link = $('<link />');
        link.attr('href', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        link.attr('rel', 'stylesheet');
        link.appendTo($('head'));
    })();
  </script>
  <script type="text/javascript" src="js/setInfor.js"></script>
  <script src="js/nav.js"></script>
  <link href="https://cdn.bootcss.com/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">
  <title><?php if($_SESSION["roomName"]=="")echo "韶关学院水电查询";else echo $_SESSION["roomName"]."的水电费"; ?></title>
</head>
<body>
  <div class="mainPart">
    <div class="checkPart">
      <div class="bigTitle">
        <span><?php if($_SESSION["roomName"]=="")echo "韶关学院水电查询";else echo $_SESSION["roomName"]."的水电费"; ?></span>
      </div>
      <div class="selectPart">
          <span class="indexButton <?php if($page=="index"){echo "inPage";}else{echo "outPage";if($_SESSION["isExist"]=="yes")echo " canSele";}?>" a1="index">水电查询</span>
          <span class="timeButton <?php if($page=="time"){echo "inPage";}else{echo "outPage";if($_SESSION["isExist"]=="yes")echo " canSele";}?>" a1="time">定向查询</span>
          <span class="topupButton <?php if($page=="charge"){echo "inPage";}else{echo "outPage";if($_SESSION["isExist"]=="yes")echo " canSele";}?>" a1="charge">充值记录</span>
          <span class="setButton <?php if($page=="set"){echo "inPage";}else{echo "outPage";if($_SESSION["isExist"]=="yes")echo " canSele";}?>" a1="set">设置</span>
      </div>
            <?php
              if($page=="index")
              {
                  include "wechechpage.php";
              }
              else if($page=="charge")
              {
                  include "charge.php";
              }
              else if($page=="time")
              {
                  include "timeFindDate.php";
              }
              else if($page=="set")
              {
                  include "setPage.php";
              }
              else
              {
                  if($_SESSION["isExist"]=="yes")
                  header("location:?page=index");
                  else
                  header("location:?page=set");
              }
            ?>
  </div>
  <div id="metrePart">
    <div class="ICT">
        <div class="logoPart" style="<?php if($page=="index"||$page=="time") echo "display:none"?>">
            <img src="img/logo1.png" id="logo1"style="display: none;width: 60px;height: auto;position:relative;left: 18px;" alt="">
            <img src="img/logo2.png" id="logo2" style="display: none;width: 30px;height: 50px;position:relative;left: -30px;top:-5px;" alt="">
            <img src="img/logo.png"  id="logoImg" alt="环创电脑工作室" style="width:60px;margin:auto;">
            <img src="img/lgoo.png" id="logoEnd" style="display: none;opacity: 0;height: 50px;widh: auto;" alt="">
            <div id="mask" style="display: none;position: relative; top: -60px; background-color: rgb(255,255,255);z-index: 1002;height:60px;left: 120px;opacity:1; -moz-opacity:0.5;"></div>
        </div>
    </div>

    <div class="madeBy" style="display: none" dokey="<?php echo $_SESSION['key']?>" autoCheck="<?php echo $_SESSION["isExist"]; ?>" roomId="<?php echo $_SESSION["roomId"]?>" buildingId="<?php echo $_SESSION["buildingId"]?>">
      MADE BY CHENHUITAO(陈慧涛)
    </div>
  </div>

</body>
</html>
