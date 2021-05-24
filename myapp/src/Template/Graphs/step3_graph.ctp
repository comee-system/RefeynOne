
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>4]); ?>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("グラフの初期表示データの設定") ?>
                    </div>
                    <div class="card-body">
                        <p>表示させるデータを選択してください</p>
                        <ul id="sortable" class="list-group">
                            <li class="list-group-item" id="num-1" >
                                <?= $this->Form->checkbox("graph_status[]",[
                                    'class'=>'graph_status_edit'
                                ]) ?>
                                <span class="ml-3" >Item 1</span>
                            </li>
                            <li class="list-group-item" id="num-2">
                                <?= $this->Form->checkbox("graph_status[]",[
                                    'class'=>'graph_status_edit'
                                ]) ?>
                                <span class="ml-3">Item 2</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="row m-3">
            <div class="col-md-6 text-center">
                <?= $this->Html->link("戻る","/graphs/step3",[
                    "class"=>"btn btn-secondary w-75",
                ])?>
            </div>
            <div class="col-md-6 text-center">
                <?= $this->Html->link("終了","/graphs/",[
                    "class"=>"btn btn-primary w-75",
                    "id"=>"finishbutton"
                ])?>
            </div>
        </div>
    </div>
</div>




