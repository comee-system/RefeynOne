
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
                            <div class="col-md-6">
                                <?= $this->Html->link("Measurementデータ出力","/graphs/outputMesurement/".$id,[
                                    "class"=>"btn btn-warning w-100 text-white",
                                    "label"=>false
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Html->link("SOP Export",[
                                        "controller"=>"graphs",
                                        "action"=>"outputSOP",
                                        $id
                                    ],
                                    [
                                        "escape"=>false,
                                        "class"=>"btn btn-warning w-100 text-white",

                                    ])?>
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




