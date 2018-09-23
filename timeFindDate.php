<?php
$startDate=date("Y-m-d",strtotime('- 5 day'));
$endDate=date("Y-m-d");
?>
<script src="js/kinerDatePicker/js/libs/flexible.debug.js"></script>
<script src="js/kinerDatePicker/js/libs/flexible_css.debug.js"></script>
<script src="js/kinerDatePicker/js/libs/mobileFix.js"></script>
<script src="js/kinerDatePicker/js/libs/swiper.min.js"></script>
<script src="js/kinerDatePicker/js/libs/kinerDatePicker.js"></script>
<script src="js/timeFind.js"></script>
<link rel="stylesheet" href="css/timefind.css">
<link rel="stylesheet" href="js/kinerDatePicker/css/index.css">
<div class="ui raised segment" style="height: 100%!important;">
    <h4 class="ui horizontal divider header">电费定向查询</h4>
    <div class="findPart">
        <div id="eleStartDate" class="dateItem"  startYear="2015" title="请选择开始时间" default-val="<?php echo $startDate?>">开始时间</div>
        <div style="width:1%;">-</div>
        <div id="eleEndDate" class="dateItem"  startYear="2015" title="请选择结束时间" default-val="<?php echo $endDate?>">结束时间</div>
    </div>
    <i class="fa fa-search"id="eleSearch" style="width: 2%;"></i>
    <div id="eleSearchPart" class="searchPart">
        <div class="ui middle aligned list weList" style="display: none;">
            <div class="item">
                <div>金额</div>
                <div>日期</div>
            </div>
        </div>
        <div class="ui loading segment" style="display: none;height:200px;margin-top: 0px;">
        </div>
    </div>
    <div id="eleTips" style="display: none">(最多显示十五条)</div>
</div>
<div class="ui raised segment" style="height: 100%!important;">
    <div class="ui horizontal divider header">水费定向查询</div>
    <div class="findPart">
        <div id="waterStartDate" class="dateItem"  startYear="2015" title="请选择开始时间" default-val="<?php echo $startDate?>">开始时间</div>
        <div style="width:1%;">-</div>
        <div id="waterEndDate" class="dateItem"  startYear="2015" title="请选择结束时间" default-val="<?php echo $endDate?>">结束时间</div>
    </div>
    <i class="fa fa-search"id="waterSearch" style="width: 2%;"></i>
    <div id="waterSearchPart" class="searchPart">
        <div class="ui middle aligned list weList" style="display: none;">
            <div class="item">
                <div>金额</div>
                <div>日期</div>
            </div>
        </div>
        <div class="ui loading segment" style="display: none;height:200px;margin-top: 0px;">
        </div>
    </div>
    <div id="waterTips" style="display: none">(最多显示十五条)</div>
</div>
