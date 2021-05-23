<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->Form->create($user,[])?>
<?php
    $col = 10;
    if($mode == "admin") $col = 12;
?>
<div class="col-<?=$col?> mt-5 mx-auto">
    <div class="card">
        <div class="card-header bg-info">
            <?= __("会員登録") ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4"><?= __("ユーザID") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <?= $this->Form->control("username",[
                        "class"=>"form-control ".$type,
                        "label"=>false,
                        "required"=>false,
                    ])?>
                    <small class="text-success">半角英数5文字以上</small>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><?= __("パスワード") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <?php
                        $op = [
                            "type"=>"password",
                            "class"=>"form-control ".$type,
                            "label"=>false,
                            "required"=>false,
                        ];
                        if($id > 0){
                            $op += [
                                "value"=>"",
                                "placeholder"=>"変更しない場合は未入力"
                            ];
                        }
                    ?>
                    <?= $this->Form->control("password",$op)?>
                    <small class="text-success">半角英数8文字以上</small>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><?= __("企業名") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <?= $this->Form->control("campany",[
                        "class"=>"form-control ".$type,
                        "label"=>false,
                        "required"=>false,
                    ])?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-4"><?= __("氏名") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-6">
                            <?= $this->Form->control("sei",[
                                "class"=>"form-control ".$type,
                                "label"=>false,
                                "required"=>false,
                            ])?>
                        </div>
                        <div class="col-6">
                            <?= $this->Form->control("mei",[
                                "class"=>"form-control ".$type,
                                "label"=>false,
                                "required"=>false,
                            ])?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><?= __("ふりがな") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-6">
                            <?= $this->Form->control("sei_kana",[
                                "class"=>"form-control ".$type,
                                "label"=>false,
                                "required"=>false,
                            ])?>
                        </div>
                        <div class="col-6">
                            <?= $this->Form->control("mei_kana",[
                                "class"=>"form-control ".$type,
                                "label"=>false,
                                "required"=>false,
                            ])?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><?= __("メールアドレス") ?>
                <span class="right badge badge-danger">必須</span>
                </div>
                <div class="col-8">
                    <?= $this->Form->control("email",[
                        "class"=>"form-control ".$type,
                        "label"=>false,
                        "required"=>false,
                    ])?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><?= __("利用期間") ?>
                </div>
                <div class="col-8">
                    <?php if($type == "conf"): ?>
                        <?= $this->Form->hidden("datestatus")?>
                        <?php if($this->request->getData( "datestatus" ) ): ?>
                            単体利用する
                        <?php endif; ?>
                    <?php else : ?>
                    <?= $this->Form->checkbox("datestatus",[
                        "value"=>1,
                        "id"=>"datestatus"
                    ]) ?>
                    <label for="datestatus">単体利用</label>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <?php
                                    if($this->request->getData('start')){
                                        $start = $this->request->getData('start');
                                        $end = $this->request->getData('end');
                                    }else{
                                        $ex  = explode("-",date("Y-m-d",strtotime($user[ 'startdate' ])));
                                        $ex2 = explode("-",date("Y-m-d",strtotime($user[ 'enddate' ])));
                                        $start[ 'year'  ] = sprintf("%d",(isset($ex[0]))?$ex[0]:0);
                                        $start[ 'month' ] = sprintf("%d",(isset($ex[1]))?$ex[1]:0);
                                        $start[ 'day'   ] = sprintf("%d",(isset($ex[2]))?$ex[2]:0);
                                        $end[ 'year'    ] = sprintf("%d",(isset($ex2[0]))?$ex2[0]:0);
                                        $end[ 'month'   ] = sprintf("%d",(isset($ex2[1]))?$ex2[1]:0);
                                        $end[ 'day'     ] = sprintf("%d",(isset($ex2[2]))?$ex2[2]:0);
                                    }
                                ?>
                                <select name="start[year]" class="form-control <?=$type?>">
                                <?php for($i=date('Y');$i<=date('Y')+3;$i++):
                                        $sel = "";
                                        if($start[ 'year' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?> ><?=$i?>年</option>
                                <?php endfor; ?>
                                </select>
                                <select name="start[month]" class="form-control <?=$type?>">
                                <?php for($i=1;$i<=12;$i++):
                                        $sel = "";
                                        if($start[ 'month' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?> ><?=$i?>月</option>
                                <?php endfor; ?>
                                </select>
                                <select name="start[day]" class="form-control <?=$type?>">
                                <?php for($i=1;$i<=31;$i++):
                                    $sel = "";
                                    if($start[ 'day' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?>><?=$i?>日</option>
                                <?php endfor; ?>
                                </select>
                                <div class="p-1">～</div>
                                <select name="end[year]" class="form-control <?=$type?>">
                                <?php for($i=date('Y');$i<=date('Y')+3;$i++):
                                    $sel = "";
                                    if($end[ 'year' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?> ><?=$i?>年</option>
                                <?php endfor; ?>
                                </select>
                                <select name="end[month]" class="form-control <?=$type?>">
                                <?php for($i=1;$i<=12;$i++):
                                    $sel = "";
                                    if($end[ 'month' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?> ><?=$i?>月</option>
                                <?php endfor; ?>
                                </select>
                                <select name="end[day]" class="form-control <?=$type?>">
                                <?php for($i=1;$i<=31;$i++):
                                    $sel = "";
                                    if($end[ 'day' ] == $i) $sel = "SELECTED";
                                    ?>
                                    <option value='<?=$i?>' <?=$sel?> ><?=$i?>日</option>
                                <?php endfor; ?>
                                </select>
                            </div>
                            <?php if(isset($error[ 'startdate' ]['date']) ): ?>
                            <span class="text-danger"><?= h($error[ 'startdate' ]['date']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <?php if ($type == "conf" ): ?>
                    <div class="row">
                        <div class="col-6">
                            <?= $this->Form->button("戻る",[
                                "class"=>"btn btn-secondary w-100",
                                "name"=>"back",
                                "value"=>"on"
                            ])?>
                        </div>
                        <div class="col-6">

                            <?= $this->Form->button("登録",[
                                "class"=>"btn btn-primary w-100",
                                "name"=>"regist",
                                "value"=>"on"
                            ])?>
                        </div>
                    </div>
                <?php else: ?>
                    <?= $this->Form->button("登録確認",[
                        "class"=>"btn btn-primary",
                        "name"=>"conf",
                        "value"=>"on"
                    ])?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>

