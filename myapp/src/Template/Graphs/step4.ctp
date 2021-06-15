
<div class="content">

    <div class="container">
        <?= $this->element("graph_step",['step'=>4]); ?>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card ">
                    <div class="card-header bg-primary">
                        <?= __("データ出力") ?>
                    </div>
                    <div class="card-body">
                        <p>今回の解析結果を保持するため、ファイルのダウンロードをおすすめします。</p>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->Form->control("取込データ出力",[
                                    "type"=>"button",
                                    "class"=>"btn btn-info w-100",
                                    "label"=>false
                                ]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Form->control("SOP設定出力",[
                                    "type"=>"button",
                                    "class"=>"btn btn-info w-100",
                                    "label"=>false
                                ]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Form->control("ヒストグラムデータ出力",[
                                    "type"=>"button",
                                    "class"=>"btn btn-info w-100",
                                    "label"=>false
                                ]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Form->control("エリア毎の結果テーブル出力",[
                                    "type"=>"button",
                                    "class"=>"btn btn-info w-100",
                                    "label"=>false
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row m-3">
            <div class="col-md-6 text-center">
                <?= $this->Html->link("戻る","/graphs/step3/".$id,[
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




