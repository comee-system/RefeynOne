
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>3]); ?>
        <?= $this->Form->hidden("id",['id'=>'id','value'=>h($id)])?>
        <?= $this->Form->create(null,[
                    "type"=>"post",
                    "url"=>[
                        "controller"=>"graphs",
                        "action"=>"editDispStatus",
                        $id
                    ]
        ]);?>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card ">
                        <div class="card-header bg-primary">
                            <?= __("選択データ変更") ?>
                        </div>
                        <div class="card-body">
                            <p>表示させるデータを選択してください</p>
                            <ul id="sortable" class="list-group">

                                <?php foreach($grafData as $key=>$value):
                                    $chk = false;
                                    if($value->disp >= 1) $chk = true;
                                    ?>
                                    <li class="list-group-item" id="num-<?=$value->id?>" >
                                        <div class="row">
                                            <div class="col-md-8">
                                                <?= $this->Form->checkbox("graph_status[$value->id]",[
                                                    'class'=>'graph_status_edit',
                                                    'checked'=>$chk,
                                                    'value'=>'on'
                                                ]) ?>
                                                <?= $this->Form->hidden("graph_sort[$value->id]",[
                                                    'value'=>$value->id
                                                ]) ?>
                                                <span class="ml-3" ><?= h($value->label) ?></span>
                                            </div>
                                            <div class="col-md-4 text-right">
                                            <i class="fas fa-arrows-alt-v"></i>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row m-3 col-10 mx-auto ">
                <div class="col-md-6 ">
                    <?= $this->Html->link("戻る","/graphs/step3/".$id,[
                        "class"=>"btn btn-secondary w-100",
                    ])?>
                </div>
                <div class="col-md-6 ">
                    <?= $this->Form->submit("決定",[
                            "class"=>"btn btn-primary w-100 ",
                            "id"=>"graph_decide"
                        ])?>
                </div>
            </div>
        <?= $this->Form->end(); ?>
    </div>
</div>




