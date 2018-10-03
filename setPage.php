<div class="roomPart">
    <span class="title">房间号：</span>
    <span id="roomBandTitle" style="display: none;margin-left: 15px;"></span>
    <div class="ui input">
        <input type="number" value="<?php echo $_SESSION["roomId"] ?>" id="roomIdButton"  placeholder="(例如104)">
    </div>
</div>
<div class="buildingPart" >
    <span class="title">楼层编号：</span>
    <span id="builBandTitle" style="display: none;margin-left: 15px;"></span>
    <select class="ui dropdown" v-model="buildingId" value="<?php echo $_SESSION["buildingId"] ?>" size="6"  id="buildingId">
        <option value="6378">碧桃20栋</option>
        <option value="1177">碧桃21栋</option>
        <option value="1250">碧桃24栋</option>
        <option value="1623">碧桃25栋</option>
        <option value="1649">碧桃27栋</option>
        <option value="1332">碧桃28栋</option>
        <option value="1366">碧桃29栋</option>
        <option value="1426">丹桂22栋</option>
        <option value="1486">丹桂23栋</option>
        <option value="1688">丹竹A栋</option>
        <option value="1811">丹竹B栋</option>
        <option value="1924">丹竹C栋</option>
        <option value="2047">碧桂B栋</option>
        <option value="2114">碧桂C栋</option>
        <option value="2202">碧桂A栋</option>
        <option value="2317">红枫A栋</option>
        <option value="2710">海棠A栋</option>
        <option value="2807">海棠B栋</option>
        <option value="2904">紫荆A栋</option>
        <option value="3151">紫荆B栋</option>
        <option value="3271">紫荆C栋</option>
        <option value="3405">紫薇A栋</option>
        <option value="3517">紫薇B栋</option>
        <option value="3629">紫薇C栋</option>
        <option value="3763">丁香A栋</option>
        <option value="3884">丁香B栋</option>
        <option value="4005">丁香C栋</option>
        <option value="4126">丁香D栋</option>
        <option value="4247">丁香E栋</option>
        <option value="4369">丁香G栋</option>
        <option value="4492">丁香F栋</option>
        <option value="4613">海棠C栋</option>
        <option value="4710">秋枫A栋</option>
        <option value="4807">秋枫B栋</option>
        <option value="4904">秋枫C栋</option>
        <option value="5001">秋枫D栋</option>
        <option value="5133">蔷薇A栋</option>
        <option value="5246">蔷薇B栋</option>
        <option value="5359">蔷薇C栋</option>
        <option value="5456">芙蓉A栋</option>
        <option value="5569">芙蓉B栋</option>
        <option value="5682">芙蓉C栋</option>
        <option value="5795">芙蓉D栋</option>
        <option value="5908">银杏A栋</option>
        <option value="6011">银杏B栋</option>
        <option value="6090">丹枫A栋</option>
        <option value="6169">丹枫B栋</option>
        <option value="6290">红棉东栋</option>
        <option value="6320">红枫B栋</option>
        <option value="6326">红棉西栋</option>
        <option value="6481">丹桂26栋</option>
        <option value="6546">黄田坝6栋</option>
        <option value="6610">黄田坝10栋</option>
        <option value="6689">黄田坝12栋</option>
        <option value="6767">黄田坝9栋</option>
        <option value="6849">紫竹A栋</option>
        <option value="6988">紫竹B栋</option>
        <option value="7169">樱花苑</option>
        <option value="7444">梧桐苑</option>
    </select>
</div>
<button id="setRoom" style="width: 100%;line-height: 100%" class="ui primary button <?php if($_SESSION["isExist"]=="yes")echo "hasBend";else echo ""; ?>"><i style="display: none;" class="fa fa-spinner fa-pulse"id="log"></i><span id="bend"><?php if($_SESSION["isExist"]=="yes")echo "取消绑定";else echo "绑定"; ?></span></button>
<div class="ui raised segment" id="roomDisExist"style="display: none;line-height: 20px !important;" >
    <div style="color:red;text-align:center;line-height: ">宿舍不存在!</div>
</div>