<?php
for($i=1;$i<=6;$i++){
    $act[$i] = "";
    if($step == $i) $act[$i] = "active";
}
?>
<div id="smartwizard" class="sw-theme-arrows">
  <ul class="nav nav-tabs step-anchor">
    <li class="<?=$act[1]?>"><a href="javascript:void(0);">Step 1<br><small>データ取込み</small></a></li>
    <li class="<?=$act[2]?>"><a href="javascript:void(0);">Step 2<br><small>取込みデータ確認</small></a></li>
    <li class="<?=$act[3]?>"><a href="javascript:void(0);">Step 3<br><small>SOPの設定</small></a></li>
    <li class="<?=$act[4]?>"><a href="javascript:void(0);">Step 4<br><small>初期データ</small></a></li>
    <li class="<?=$act[5]?>"><a href="javascript:void(0);">Step 5<br><small>解析</small></a></li>
    <li class="<?=$act[6]?>"><a href="javascript:void(0);">Step 6<br><small>データ出力</small></a></li>
  </ul>
</div>
