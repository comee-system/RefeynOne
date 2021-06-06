
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("グラフの初期表示データの設定") ?>
                    </div>
                    <div class="card-body">
                        <p>表示させるデータを選択してください</p>
                        <ul id="sortable" class="list-group">

                            <?php foreach($grafData as $key=>$value):
                                $chk = false;
                                if($value->disp >= 1) $chk = true;
                                ?>
                                <li class="list-group-item" id="num-<?=$value->id?>" >
                                    <?= $this->Form->checkbox("graph_status[]",[
                                        'class'=>'graph_status_edit',
                                        'checked'=>$chk
                                    ]) ?>
                                    <span class="ml-3" ><?= h($value->label) ?></span>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="row m-3">
            <div class="col-md-6 mx-auto">
                <?= $this->Html->link("戻る","/graphs/step3/".$id,[
                    "class"=>"btn btn-secondary w-100",
                ])?>
            </div>
        </div>
    </div>
</div>




