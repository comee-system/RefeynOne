<?php
for($i=1;$i<=6;$i++){
    $act[$i] = "";
    if($step == $i) $act[$i] = "active";
}
?>
<div id="smartwizard" class="sw-theme-arrows">
  <ul class="nav nav-tabs step-anchor">
    <li class="<?=$act[1]?>"><a href="javascript:void(0);">Step 1<small>データ取込</small></a></li>
    <li class="<?=$act[2]?>"><a href="javascript:void(0);">Step 2<small>初期値設定</small></a></li>
    <li class="<?=$act[3]?>"><a href="javascript:void(0);">Step 3<small>解析</small></a></li>
    <li class="<?=$act[4]?>"><a href="javascript:void(0);">Step 4<small>データ出力</small></a></li>
  </ul>
</div>
