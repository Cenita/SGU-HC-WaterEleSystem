<script src="js\charge.js"></script>
<div class="ui raised segment" style="height: 100%!important;">
    <h4 class="ui horizontal divider header"><?php echo $_SESSION["roomName"];?>充值记录表</h4>
    <div id="TopUpPart">
        <div class="ui middle aligned list">
            <div class="item">
                <div>充值金额</div>
                <div>充值类型</div>
                <div>日期</div>
            </div>
            <div class="ui loading segment" style="height:200px;">
        </div>
    </div>
    <div class="information" style="display: none" ri="<?php echo $_SESSION["roomId"]?>" bi="<?php echo $_SESSION["buildingId"]?>" ke="<?php echo $_SESSION["key"]?>"></div>
</div>